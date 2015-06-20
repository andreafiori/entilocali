<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Amazon\S3\S3Helper;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Attachments\AttachmentsForm;
use ModelModule\Model\Attachments\AttachmentsFormInputFilter;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetter;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use Application\Controller\SetupAbstractController;

/**
 * Attachment data insert and storage
 */
class AttachmentsInsertController extends SetupAbstractController
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

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        $inputFilter = new AttachmentsFormInputFilter();
        $moduleCode = $this->params()->fromRoute('modulename');

        $form = new AttachmentsForm();
        $form->setBindOnValidate(false);
        $form->setInputFilter( $inputFilter->getInputFilter() );
        $form->setData($post);

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $helper = new AttachmentsControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        $s3Helper = new S3Helper();

        try {

            if (!$form->isValid()) {
                throw new NullException("The form is not valid");
            }

            $inputFilter->exchangeArray( $form->getData() );

            $helper->setLoggedUser($userDetails);

            /* Check S3 keys */
            $configurations = $this->layout()->getVariable('configurations');
            $s3AccessKey = isset($configurations['amazon_s3_accesskey']) ? $configurations['amazon_s3_accesskey'] : null;
            $s3SecretKey = isset($configurations['amazon_s3_secretkey']) ? $configurations['amazon_s3_secretkey'] : null;

            $s3Helper->setAccessKey($s3AccessKey);
            $s3Helper->setSecretKey($s3SecretKey);
            $s3Helper->setBucket( isset($configurations['amazon_s3_bucket']) ? $configurations['amazon_s3_bucket'] : null );
            $s3Helper->setS3Directory($inputFilter->s3_directory);
            $s3Helper->setS3( new S3($s3AccessKey, $s3SecretKey) );

            /* Recover MIME */
            $mimeRecords = $helper->recoverWrapperRecords(
                new AttachmentsMimetypeGetterWrapper(new AttachmentsMimetypeGetter($em)),
                array(
                    'mimetype' => $inputFilter->attachmentFile['type'],
                    'limit'    => 1,
                )
            );
            $helper->checkRecords($mimeRecords, "Il tipo di file inserito non &egrave; supportato. Per ulteriori informazioni contattare l'amministrazione");

            $helper->insertAttachments($inputFilter, $mimeRecords[0]['id']);
            $lastInsertId = $helper->getConnection()->lastInsertId();
            $attachmentFileName = $s3Helper->assignFileName($inputFilter->attachmentFile['name'], $lastInsertId);
            $helper->updateAttachmentsFilename($lastInsertId, $attachmentFileName);
            $helper->insertAttachmentsOptions($inputFilter, $lastInsertId);
            $helper->insertAttachmentsRelations($inputFilter, $lastInsertId);

            $s3Helper->upload(
                $inputFilter->attachmentFile['tmp_name'],
                $attachmentFileName
            );

            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::recoverIdFromModuleCode($moduleCode),
                'message'       => "Inserito nuovo allegato ".$inputFilter->title,
                'type'          => 'info',
                'reference_id'  => $lastInsertId,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'                => 'success',
                'messageTitle'               => 'Allegato inserito correttamente',
                'messageText'                => 'I dati sono stati processati correttamente dal sistema',
                'showLinkResetFormAndShowIt' => 1,
                'backToSummaryText'          => "Elenco file allegati",
                'insertAgainLabel'           => "Inserisci un altro file allegato",
            ));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $dbEx) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::recoverIdFromModuleCode($moduleCode),
                'message'       => "Errore inserimento nuovo file allegato: ".$inputFilter->title,
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore inserimento file allegato',
                'messageText'           => $e->getMessage(),
                'form'                  => $form,
                'formInputFilter'       => $inputFilter->getInputFilter(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => 'Torna al form di inserimento dati',
            ));
        }

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}