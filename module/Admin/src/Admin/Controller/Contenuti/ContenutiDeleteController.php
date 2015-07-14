<?php

namespace Admin\Controller\Contenuti;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Amazon\S3\S3;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use ModelModule\Model\HomePage\HomePageHelper;
use ModelModule\Model\HomePage\HomePagePutRemoveControllerHelper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;

/**
 * TODO: delete from contenuti, delete attachments (if there some), attachments_options, attachments_relation
 */
class ContenutiDeleteController extends SetupAbstractController
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

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $moduleId = $this->params()->fromRoute('modulename') == 'contenuti' ? ModulesContainer::contenuti_id : ModulesContainer::amministrazione_trasparente_id;

        $helper = new ContenutiControllerHelper();

        try {


            $contentRecord = $helper->recoverWrapperRecordsById(
                new ContenutiGetterWrapper(new ContenutiGetter($em)),
                array('id' => $post['deleteId'], 'limit' => 1),
                $post['deleteId']
            );
            $helper->checkRecords($contentRecord, 'Articolo da eliminare non trovato');
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->delete($post['deleteId']);
            $helper->getConnection()->commit();

            /* Delte Attachments files */
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
                        $this->params()->fromRoute('modulename').'/'.$attachmentRecord[0]['name']
                    );
                }

            }

            /* Delete from home page */
            $homeHelper = new HomePagePutRemoveControllerHelper();
            $homePageRecords = $homeHelper->recoverWrapperRecords(
                new HomePageGetterWrapper(new HomePageGetter($em)),
                array(
                    'referenceId' =>  $post['deleteId'],
                    'moduleId'    =>  $moduleId,
                    'moduleCode'  => $this->params()->fromRoute('modulename'),
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
                'module_id'     => ModulesContainer::recoverIdFromModuleCode($this->params()->fromRoute('modulename')),
                'message'       => "Eliminato articolo ".$contentRecord[0]['titolo'],
                'type'          => 'info',
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

        } catch(\Exception $e) {

            try {
                // $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $dbEx) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore eliminazione file articolo ",
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
                'messageTitle'          => 'Errore eliminazione contenuto',
                'messageText'           => $e->getMessage(),
                'previousPageLink'      => (isset($refererLink)) ? $refererLink : null,
                'previousPageLabel'     => "Torna all'elenco",
                'templatePartial'       => "message.phtml",
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}