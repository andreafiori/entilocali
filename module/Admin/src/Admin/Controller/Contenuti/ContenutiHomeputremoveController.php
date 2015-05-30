<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Contenuti\HomePagePutRemoveControllerHelper;
use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;

class ContenutiHomeputremoveController extends SetupAbstractController
{
    /**
     * Aggiunger record in homepage, aggiorna flag home in contenuti, log operazione
     */
    public function putAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new HomePagePutRemoveControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();
        try {
            $helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(new ContenutiGetter($em)) );
            $helper->setupContenutiRecords(array(
                'id'    => $id,
                'limit' => 1,
            ));
            $helper->checkContenutiRecords();
            $helper->setHomePageBlocksGetterWrapper( new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($em)) );
            $helper->setupHomePageBlocksRecords(array(
                'fields'    => 'homePageBlocks.id',
                'moduleId'  => ModulesContainer::contenuti_id,
                'limit'     => 1,
            ));
            $helper->checkHomePageBlocksRecords();
            $helper->insertInHomePage($id);
            $helper->updateContenutiHome($id);
            $helper->setLogWriter(new LogWriter($connection));

            $contenutoRecords = $helper->getContenutiRecords();

            $helper->getLogWriter()->writeLog(array(
                'user_id'   => isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' => ModulesContainer::contenuti_id,
                'message'   => "Inserito in home page il contenuto ".$contenutoRecords[0]['titolo'],
                'type'      => 'error',
                'backend'   => 1,
            ));

            $helper->getConnection()->commit();

            return $this->redirect()->toRoute('admin/contenuti-summary', array('lang'=>'it'));

        } catch(\Exception $e) {

            $helper->getConnection()->rollBack();

            try {

                $helper->setLogWriter(new LogWriter($connection));
                $helper->getLogWriter()->writeLog(array(
                    'user_id'   => isset($userDetails->id) ? $userDetails->id : 1,
                    'module_id' => ModulesContainer::contenuti_id,
                    'message'   => "Errore inserimento contenuto in home page",
                    'type'      => 'error',
                    'backend'   => 1,
                ));

                $this->layout()->setVariables(array(
                    'messageType'       => 'danger',
                    'messageTitle'      => 'Errore inserimento contenuto in home page',
                    'messageText'       => $e->getMessage(),
                    'templatePartial'   => 'message.phtml',
                ));

            } catch(\Exception $e) {

                $this->layout()->setVariables(array(
                    'messageType' => 'danger',
                    'messageTitle' => 'Errore verificato',
                    'messageText' => "Errore inserimento contenuto in home page e log operazione",
                    'templatePartial' => 'message.phtml',
                ));

            }

            $this->layout()->setTemplate($mainLayout);
        }
    }

    /**
     * Rimuove dalla home page
     *
     * TODO: delete record on homepage table, update contenuti home flag to 0
     */
    public function removeAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $connection->beginTransaction();

        $helper = new HomePagePutRemoveControllerHelper();
        $helper->setConnection($connection);

        $helper->getConnection()->beginTransaction();
        try {
            $helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(new ContenutiGetter($em)) );
            $helper->setupContenutiRecords(array(
                'id'    => $id,
                'limit' => 1,
            ));
            $helper->checkContenutiRecords();
            $helper->setHomePageBlocksGetterWrapper( new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($em)) );
            $helper->setupHomePageBlocksRecords(array(
                'fields'    => 'homePageBlocks.id',
                'moduleId'  => ModulesContainer::contenuti_id,
                'limit'     => 1,
            ));
            $helper->checkHomePageBlocksRecords();

            $helper->getConnection()->commit();

            $homePageBlockRecords = $helper->getHomePageBlocksRecords();
            $helper->deleteFromHomePage($id, $homePageBlockRecords[0]['id']);
            $helper->updateContenutiHome($id, 0);

            $helper->getConnection()->commit();

            return $this->redirect()->toRoute('admin/contenuti-summary', array('lang'=>'it'));

        } catch(\Exception $e) {

            $helper->getConnection()->rollBack();

        }

        $this->layout()->setTemplate($mainLayout);
    }
}