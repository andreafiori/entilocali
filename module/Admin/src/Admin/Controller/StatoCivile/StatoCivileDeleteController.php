<?php

namespace Admin\Controller\StatoCivile;

use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use ModelModule\Model\HomePage\HomePagePutRemoveControllerHelper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * Stato Civile Delete Controller
 *
 * TODO: Delete from stato civile, delete attachments, delete from home page, log operation result
 */
class StatoCivileDeleteController extends SetupAbstractController
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

        $mainLayout = $this->initializeAdminArea();

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $moduleId = ModulesContainer::stato_civile_id;
        $moduleCode = 'stato-civile';

        $helper = new StatoCivileControllerHelper();
        $helper->setConnection($connection);

        try {

            $contentRecord = $helper->recoverWrapperRecordsById(
                new StatoCivileGetterWrapper( new StatoCivileGetter($em) ),
                array('id' => $post['deleteId'], 'limit' => 1),
                $post['deleteId']
            );
            $helper->checkRecords($contentRecord, 'Atto da eliminare non trovato');
            $helper->getConnection()->beginTransaction();
            $helper->delete($post['deleteId']);
            $helper->getConnection()->commit();

            $attachmentsHelper = new AttachmentsControllerHelper();
            $attachmentsHelper->setConnection($connection);
            $attachmentsRecords = $helper->recoverWrapperRecords(
                new AttachmentsGetterWrapper( new AttachmentsGetter($em) ),
                array(
                    'referenceId'   => $post['deleteId'],
                    'moduleId'      => $moduleId,
                )
            );
            if (!empty($attachmentsRecords)) {

                foreach($attachmentsRecords as $attachmentRecord) {
                    $attachmentsHelper->deleteAttachments($attachmentsRecords['id']);
                    $attachmentsHelper->deleteAttachmentsRelations($attachmentsRecords['id']);

                    $s3 = new S3($configurations['amazon_s3_accesskey'], $configurations['amazon_s3_secretkey']);
                    $s3->deleteObject(
                        $configurations['amazon_s3_bucket'],
                        $moduleCode.'/'.$attachmentRecord[0]['name']
                    );
                }

            }

            $homeHelper = new HomePagePutRemoveControllerHelper();
            $homePageRecords = $homeHelper->recoverWrapperRecords(
                new HomePageGetterWrapper(new HomePageGetter($em)),
                array(
                    'referenceId' =>  $post['deleteId'],
                    'moduleId'    =>  $moduleId,
                    'moduleCode'  =>  $moduleCode,
                )
            );
            if (!empty($homePageRecords)) {

                $homePageBlocksRecords = $helper->recoverWrapperRecords(
                    new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($em)),
                    array(
                        'fields'    => 'homePageBlocks.id',
                        'moduleId'  => $moduleId,
                        'limit'     => 1,
                    )
                );
                $helper->checkRecords(
                    $homePageBlocksRecords,
                    'Impossibile recuperare i dati relativi al modulo in home page'
                );

                $homeHelper->setConnection($connection);
                $homeHelper->getConnection()->beginTransaction();
                $homeHelper->deleteFromHomePage($post['deleteId'], $homePageBlocksRecords[0]['id']);
                $homeHelper->getConnection()->commit();
            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::recoverIdFromModuleCode($moduleCode),
                'message'       => "Eliminato atto stato civile ".$contentRecord[0]['titolo'],
                'type'          => 'info',
                'reference_id'  => $post['deleteId'],
                'backend'       => 1,
            ));

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
                'module_id'     => ModulesContainer::stato_civile_id,
                'message'       => "Errore eliminazione file atto stato civile",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $post['deleteId'],
                'backend'       => 1,
            ));

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                $refererLink = $referer->getUri();
            }

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore eliminazione atto stato civile',
                'messageText'           => $e->getMessage(),
                'previousPageLink'      => (isset($refererLink)) ? $refererLink : null,
                'previousPageLabel'     => "Torna all'elenco",
                'templatePartial'       => "message.phtml",
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}