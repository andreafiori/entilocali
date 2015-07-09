<?php

namespace Admin\Controller\Photo;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsFormInputFilter;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;

class PhotoUpdateController extends SetupAbstractController
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
        $moduleId = ModulesContainer::photo;

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper = new PostsControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);

            $publicDirPath = $helper->recoverPublicDirPath($this->layout()->getVariable('isPublicDirOnRoot'));

            if ($inputFilter->image) {
                $records = $helper->recoverWrapperRecordsById(
                    new PostsGetterWrapper(new PostsGetter($em)),
                    array('id' => $inputFilter->id, 'limit' => 1, 'fields' => 'p.image'),
                    $inputFilter->id
                );
                $helper->checkRecords('Dati foto corrente non trovati');
                $currentImage = isset($records[0]['image']) ? $records[0]['image'] : null;

                $mediaDir = $helper->checkMediaDir($configurations);
                $mediaProject = $helper->checkMediaProject($configurations);

                /* Delete old image */
                $oldImageThumbPath = $publicDirPath.$mediaDir.$mediaProject.'photo/thumbs/'.$currentImage;
                $oldImageBigPath = $publicDirPath.$mediaDir.$mediaProject.'photo/big/'.$currentImage;
                if (file_exists($oldImageThumbPath) and $currentImage!='') {
                    unlink($oldImageThumbPath);
                }
                if (file_exists($oldImageBigPath) and $currentImage!='') {
                    unlink($oldImageBigPath);
                }

                $imagePathInfo = pathinfo($inputFilter->image['name']);
                $newFilename = $inputFilter->id.'_'.uniqid().'.'.$imagePathInfo['extension'];
                $thumbWitdth = isset($configurations['photo_image_width']) ? $configurations['photo_image_width'] : 160;
                $thumbHeight = isset($configurations['photo_image_height']) ? $configurations['photo_image_height'] : 130;

                $imagine = new \Imagine\Gd\Imagine();
                $imagine->open($inputFilter->image['tmp_name'])
                    ->thumbnail(
                        new \Imagine\Image\Box($thumbWitdth, $thumbHeight),
                        \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                    )
                    ->save($publicDirPath.$mediaDir.$mediaProject.'/photo/thumbs/'.$newFilename)
                ;

                move_uploaded_file($inputFilter->image['tmp_name'], $publicDirPath.$mediaDir.$mediaProject.'/photo/big/'.$newFilename);

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
                'message'       => "Aggiornata foto ".$inputFilter->title,
                'type'          => 'info',
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Foto aggiornata correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna ai dati della foto",
                'backToSummaryLink'     => $this->url()->fromRoute('admin/photo-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'backToSummaryText'     => "Elenco foto",
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
                'message'       => "Errore aggiornamento foto",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $inputFilter->id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore aggiornamento foto',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco foto",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}