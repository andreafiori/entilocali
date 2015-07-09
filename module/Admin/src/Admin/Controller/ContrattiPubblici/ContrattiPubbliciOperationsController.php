<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use Application\Controller\SetupAbstractController;

/**
 * Contratti Pubblici Operations Controller
 */
class ContrattiPubbliciOperationsController extends SetupAbstractController
{
    /**
     * @return mixed
     */
    public function enableAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new ContrattiPubbliciControllerHelper();
        $helper->setConnection($connection);

        try {

            $helper->getConnection()->beginTransaction();
            $helper->updateAttivo($id, 1);

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => ModulesContainer::contratti_pubblici_id,
                'message'   => "Contratto reso visibile sul sito pubblico ID: ".$id,
                'type'      => 'info',
                'backend'   => 1,
            ));

            $helper->getConnection()->commit();

            if (is_object($this->getRequest()->getHeader('Referer'))) {
                return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
            }

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   	=> isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' 	=> ModulesContainer::contratti_pubblici_id,
                'message'   	=> "Errore nell'operazione di resa visibile bando di gara sul sito pubblico. ID: ".$id,
                'type'      	=> 'error',
                'reference_id'	=> $id,
                'backend'   	=> 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'     => 'danger',
                'messageTitle'    => 'Errore verificato',
                'messageText'     => $e->getMessage(),
                'templatePartial' => 'message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);
        }
    }

    /**
     * @return mixed
     */
    public function disableAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new ContrattiPubbliciControllerHelper();
        $helper->setConnection($connection);

        try {

            $helper->getConnection()->beginTransaction();
            $helper->updateAttivo($id, 0);

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => ModulesContainer::contratti_pubblici_id,
                'message'   => "Contratto reso disattivato sul sito pubblico. ID: ".$id,
                'type'      => 'info',
                'backend'   => 1,
            ));

            $helper->getConnection()->commit();

            if (is_object($this->getRequest()->getHeader('Referer'))) {
                return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
            }

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   	=> isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' 	=> ModulesContainer::contratti_pubblici_id,
                'message'   	=> "Errore nell'operazione di resa visibile bando di gara sul sito pubblico. ID: ".$id,
                'type'      	=> 'error',
                'reference_id'	=> $id,
                'backend'   	=> 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'     => 'danger',
                'messageTitle'    => 'Errore verificato',
                'messageText'     => $e->getMessage(),
                'templatePartial' => 'message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);
        }
    }
}