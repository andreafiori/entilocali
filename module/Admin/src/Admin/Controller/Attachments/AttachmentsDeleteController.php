<?php

namespace Admin\Controller\Attachments;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Amazon\S3\S3;

/**
 * TODO: delete attachments, options, relations, delete file on S3
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

        $this->initializeAdminArea();

        $userDetails = $this->recoverUserDetails();

        try {

            $helper =  new AttachmentsControllerHelper();
            $helper->setConnection($connection);
            $helper->getConnection()->beginTransaction();
            $helper->setLoggedUser($userDetails);
            // $helper->delete($inputFilter);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Eliminato file allegato ",
                'type'          => 'info',
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'success',
                'messageTitle'          => 'Allegato eliminato correttamente',
                'messageText'           => 'I dati sono stati processati correttamente dal sistema',
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco file",
                'backToSummaryText'     => "Elenco file",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore eliminazione file allegato ",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore eliminazione file allegato',
                'messageText'           => $e->getMessage(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco file",
            ));

            $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
        }
    }
}