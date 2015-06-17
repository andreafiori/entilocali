<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsFormInputFilter;

class BlogsInsertController extends SetupAbstractController
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

        $userDetails = $this->recoverUserDetails();

        $helper = new PostsControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $languageRecords = $helper->recoverWrapperRecords(
                new LanguagesGetterWrapper(new LanguagesGetter($em)),
                array(
                    'abbrev1' => $this->params()->fromRoute('languageSelection'),
                    'fields' => 'languages.id'
                )
            );
            $helper->checkRecords($languageRecords,'Nessun dato relativo alle lingue');
            $inputFilter->languageId = $languageRecords[0]['id'];

            $helper->setLoggedUser($userDetails);
            $helper->insert($inputFilter);
            $lastInsertId = $helper->getConnection()->lastInsertId();
            if ($inputFilter->image) {
                $imagePathInfo = pathinfo($inputFilter->image['name']);
                $imagine = new \Imagine\Gd\Imagine();
                $size    = new \Imagine\Image\Box(160, 130);
                $mode    = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                $newFilename = '1_'.uniqid().'.'.$imagePathInfo['extension'];
                $imagine->open($inputFilter->image['tmp_name'])
                        ->thumbnail($size, $mode)
                        ->save('public/frontend/media/blogs/demo/thumbs/'.$newFilename)
                ;

                move_uploaded_file($inputFilter->image['tmp_name'], 'public/frontend/media/blogs/demo/big/'.$newFilename);
            }

            foreach($inputFilter->categories as $category) {
                $helper->insertRelation($inputFilter, $lastInsertId, $category);
            }
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'message'       => "Inserita nuovo blog post ".$inputFilter->title,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Blog post inserito correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryLink'          => $this->url()->fromRoute('admin/blogs-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'backToSummaryText'     => "Elenco posts",
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $ex) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::blogs,
                'message'       => "Errore inserimento nuovo blog post: ".$inputFilter->title,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento nuovo blog post',
                'messageText'           => 'Messaggio generato: '.$e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}