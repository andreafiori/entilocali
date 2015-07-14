<?php

namespace Admin\Controller\Attachments;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Amazon\S3\S3Helper;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;

/**
 * Delete attachments, options, relations, delete file on AWS S3
 */
class AttachmentsDeleteController extends SetupAbstractController
{
    public function indexAction()
    {
        $id = $this->params()->fromPost('id');

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

        $mainLayout = $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        $helper = new AttachmentsControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            $helper->setLoggedUser($userDetails);

            $attachmentRecord = $helper->recoverWrapperRecordsById(
                new AttachmentsGetterWrapper(new AttachmentsGetter($em)),
                array('id' => $post['deleteId'], 'limit' => 1),
                $post['deleteId']
            );

            $helper->checkRecords($attachmentRecord, 'Dati file allegato non trovati');

            $configurations = $this->layout()->getVariable('configurations');

            $s3 = new S3($configurations['amazon_s3_accesskey'], $configurations['amazon_s3_secretkey']);
            $s3->deleteObject(
                $configurations['amazon_s3_bucket'],
                $this->params()->fromRoute('modulename').'/'.$attachmentRecord[0]['name']
            );

            $helper->deleteAttachments($post['deleteId']);
            $helper->deleteAttachmentsRelations($post['deleteId']);

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::recoverIdFromModuleCode($this->params()->fromRoute('modulename')),
                'message'       => "Eliminato file allegato ",
                'type'          => 'info',
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $helper->getConnection()->commit();

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $dbEx) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore eliminazione file allegato",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                $refererLink = $referer->getUri();
            }

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore eliminazione file allegato',
                'messageText'           => $e->getMessage(),
                'previousPageLink'      => (isset($refererLink)) ? $refererLink : null,
                'previousPageLabel'     => "Torna all'elenco allegati",
                'templatePartial'       => "message.phtml",
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}