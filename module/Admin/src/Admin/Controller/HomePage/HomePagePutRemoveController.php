<?php

namespace Admin\Controller\HomePage;

use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\HomePage\HomePagePutRemoveControllerHelper;
use Application\Controller\SetupAbstractController;

/**
 * Home Page Put \ Remove elements Controller
 */
class HomePagePutRemoveController extends SetupAbstractController
{
    /**
     * Put contratto in home page, update home flag
     */
    public function putAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $referenceId = $this->params()->fromRoute('referenceid');
        $moduleCode = $this->params()->fromRoute('modulecode');
        $languageId = ($this->params()->fromRoute('languageid')) ? $this->params()->fromRoute('languageid') : 1;

        $moduleId = ModulesContainer::recoverIdFromModuleCode($moduleCode);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new HomePagePutRemoveControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!$moduleId) {
                throw new NullException("Impossibile recuperare l'ID relativo al modulo");
            }

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

            $helper->insertInHomePage(
                $referenceId,
                $homePageBlocksRecords[0]['id'],
                $languageId
            );
            $helper->updateHomeFlag(
                DbTableContainer::recoverMainTableFromModuleCode($moduleCode),
                $referenceId,
                $helper->recoverHomeFlagFromModuleCode($moduleCode),
                1
            );

            $helper->getConnection()->commit();

            if (is_object($this->getRequest()->getHeader('Referer'))) {
                return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
            }

        } catch(\Exception $e) {

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   	=> isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' 	=> ModulesContainer::contenuti_id,
                'message'   	=> "Errore nell'operazione di resa visibile bando di gara sul sito pubblico. ID: ".$referenceId,
                'type'      	=> 'error',
                'reference_id'	=> $referenceId,
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
     * Delete element from home page: recover blockID, remove record from homepage, update related module home flag
     *
     * @return \Zend\Http\Response
     */
    public function removeAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $referenceId = $this->params()->fromRoute('referenceid');
        $moduleCode = $this->params()->fromRoute('modulecode');

        $moduleId = ModulesContainer::recoverIdFromModuleCode($moduleCode);

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new HomePagePutRemoveControllerHelper();
        $helper->setConnection($em->getConnection());
        $helper->getConnection()->beginTransaction();

        try {

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
            $helper->deleteFromHomePage($referenceId, $homePageBlocksRecords[0]['id']);
            $helper->updateHomeFlag(
                DbTableContainer::recoverMainTableFromModuleCode($moduleCode),
                $referenceId,
                $helper->recoverHomeFlagFromModuleCode($moduleCode),
                0
            );
            $helper->getConnection()->commit();

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

            return $this->redirect()->toRoute('main');

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $dbEx) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'   	=> isset($userDetails->id) ? $userDetails->id : 1,
                'module_id' 	=> ModulesContainer::contenuti_id,
                'message'   	=> "Errore nell'operazione di resa visibile bando di gara sul sito pubblico. ID: ".$referenceId,
                'type'      	=> 'error',
                'reference_id'	=> $referenceId,
                'backend'   	=> 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'     => 'danger',
                'messageTitle'    => 'Errore verificato',
                'messageText'     => $e->getMessage(),
                'templatePartial' => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}