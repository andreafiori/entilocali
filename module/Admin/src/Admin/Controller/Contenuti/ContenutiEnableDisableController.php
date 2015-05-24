<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Contenuti\ContenutiOperationsModel;
use Admin\Model\Log\LogWriter;
use Admin\Model\Modules\ModulesContainer;
use Application\Controller\SetupAbstractController;

/**
 * Controller mostra \ nasconde contenuto e effettua redirect tornando al sommario
 */
class ContenutiEnableDisableController extends SetupAbstractController
{
    /**
     * Attiva contenuto
     */
    public function enableAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $operationModel = $this->setupContenutiOperations($em, $connection, $id, 1);

        $contenutiRecords = $operationModel->getContenutiRecords();

        $contenutiRecordsTitle = isset($contenutiRecords[0]['titolo']) ? $contenutiRecords[0]['titolo'] : '';

        try {

            $operationModel->getLogWriter()->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => ModulesContainer::contenuti_id,
                'message'   => "Contenuto ".$contenutiRecordsTitle." reso visibile al sito pubblico",
                'type'      => 'info',
                'backend'   => 1,
            ));

            $operationModel->getConnection()->commit();

            return $this->redirect()->toRoute('admin/contenuti-summary', array('lang'=>'it'));

        } catch(\Exception $e) {

            $operationModel->getLogWriter()->writeLog(array(
                'user_id'   => isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' => ModulesContainer::contenuti_id,
                'message'   => "Contenuto reso visibile al sito pubblico",
                'type'      => 'error',
                'backend'   => 1,
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
     * Nasconde contenuto al sito pubblico
     */
    public function disableAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $operationModel = $this->setupContenutiOperations($em, $connection, $id, 0);

        $contenutiRecords = $operationModel->getContenutiRecords();

        $contenutiRecordsTitle = isset($contenutiRecords[0]['titolo']) ? $contenutiRecords[0]['titolo'] : '';

        try {

            $operationModel->getLogWriter()->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => ModulesContainer::contenuti_id,
                'message'   => "Contenuto ".$contenutiRecordsTitle." nascosto sul sito pubblico",
                'type'      => 'info',
                'backend'   => 1,
            ));

            $operationModel->getConnection()->commit();

            return $this->redirect()->toRoute('admin/contenuti-summary', array('lang'=>'it'));

        } catch(\Exception $e) {

            $operationModel->getLogWriter()->writeLog(array(
                'user_id'   => isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' => ModulesContainer::contenuti_id,
                'message'   => "Errore nel tentativo di rendere visibile il contenuto ".$contenutiRecordsTitle,
                'type'      => 'error',
                'backend'   => 1,
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
         * @param $em
         * @param $id
         * @param $connection
         * @return ContenutiOperationsModel
         * @throws \Application\Model\NullException
         */
        private function setupContenutiOperations($em, $connection, $id, $attivoValue = 1)
        {
            $operationModel = new ContenutiOperationsModel();
            $operationModel->setEntityManager($em);
            $operationModel->setContenutiGetterWrapper(new ContenutiGetterWrapper(new ContenutiGetter($em)));
            $operationModel->setupContenutiRecords(array('id' => (is_numeric($id)) ? $id : 0, 'limit' => 1));
            $operationModel->checkContenutiRecords();
            $operationModel->setupConnection();
            $operationModel->getConnection()->beginTransaction();
            $operationModel->updateAttivo($id, $attivoValue);
            $operationModel->setLogWriter(new LogWriter($connection));

            return $operationModel;
        }
}