<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsFormInputFilter;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;

class BlogsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $inputFilter = new PostsFormInputFilter();

        $form = new PostsForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $configurations = $this->layout()->getVariable('configurations');
        $userDetails = $this->recoverUserDetails();
        $moduleId = ModulesContainer::blogs;

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper = new PostsControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);

            if ($inputFilter->image) {
                $records = $helper->recoverWrapperRecordsById(
                    new PostsGetterWrapper(new PostsGetter($em)),
                    array('id' => $inputFilter->id, 'limit' => 1, 'fields' => 'p.image'),
                    $inputFilter->id
                );
                $helper->checkRecords('Dati post corrente non trovati');
                $currentImage = isset($records[0]['image']) ? $records[0]['image'] : null;

                $mediaDir = $helper->checkMediaDir($configurations);
                $mediaProject = $helper->checkMediaProject($configurations);

                $oldImageThumbPath = $mediaDir.$mediaProject.'/blogs/thumbs/'.$currentImage;
                $oldImageBigPath = $mediaDir.$mediaProject.'/blogs/big/'.$currentImage;
                if (file_exists($oldImageThumbPath) and $currentImage!='') {
                    unlink($oldImageThumbPath);
                }
                if (file_exists($oldImageBigPath) and $currentImage!='') {
                    unlink($oldImageBigPath);
                }

                $imagePathInfo = pathinfo($inputFilter->image['name']);
                $newFilename = $inputFilter->id.'_'.uniqid().'.'.$imagePathInfo['extension'];
                $thumbWitdth = isset($configurations['blogs_image_width']) ? $configurations['blogs_image_width'] : 160;
                $thumbHeight = isset($configurations['blogs_image_height']) ? $configurations['blogs_image_height'] : 130;

                $imagine = new \Imagine\Gd\Imagine();
                $imagine->open($inputFilter->image['tmp_name'])
                    ->thumbnail(
                        new \Imagine\Image\Box($thumbWitdth, $thumbHeight),
                        \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                    )
                    ->save($mediaDir.$mediaProject.'/blogs/thumbs/'.$newFilename)
                ;

                move_uploaded_file($inputFilter->image['tmp_name'], $mediaDir.$mediaProject.'/blogs/big/'.$newFilename);

                $inputFilter->image = $newFilename;
            }
            $helper->update($inputFilter);
            /* Delete old relations */
            $helper->deleteRelation($inputFilter->id, $moduleId);
            /* Insert Relations */
            foreach($inputFilter->categories as $category) {
                $inputFilter->moduleId = $moduleId;
                $helper->insertRelation($inputFilter, $inputFilter->id, $category);
            }
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => $moduleId,
                'message'       => "Aggiornato blog post ".$inputFilter->title,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Post aggiornato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna ai dati del post",
                'backToSummaryLink'     => $this->url()->fromRoute('admin/blogs-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'attachmentsLink' => $this->url()->fromRoute('admin/attachments-summary', array(
                    'lang'          => $this->params()->fromRoute('lang'),
                    'module'        => 'blogs',
                    'referenceId'   => $inputFilter->id,
                )),
                'backToSummaryText'     => "Elenco posts",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $exDb) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => $moduleId,
                'message'       => "Errore aggiornamento post",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento post',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna al form posts",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}