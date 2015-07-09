<?php

namespace Application\Controller;

use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use ModelModule\Model\HomePage\HomePageHelper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\NullException;

class IndexController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang = $this->layout()->getVariable('lang');
        $configurations = $this->layout()->getVariable('configurations');

        try {

            $helper = new HomePageHelper();
            $homePageWrapper = $helper->recoverWrapper(
                new HomePageGetterWrapper(new HomePageGetter($em)),
                array(
                    'onlyActiveModules'     => 1,
                    'orderBy'               => 'homePageBlocks.position ASC',
                    'languageAbbreviation'  => $lang
                )
            );
            $homePageRecords = $homePageWrapper->getRecords();
            $helper->checkRecords($homePageRecords, 'Nessun elemento in home page');

            $sortedHomePageRecordsPerModuleCode = $helper->gatherReferenceIds(
                $homePageWrapper->formatPerModuleCode($homePageRecords)
            );

            $helper->checkClassMapFromRecords($sortedHomePageRecordsPerModuleCode);

            $homePageElements = array();
            foreach($sortedHomePageRecordsPerModuleCode as $key => $value) {
                $obj = $helper->recoverClassMapKey($key);

                if (!empty($obj)) {

                    /**
                     * @var \ModelModule\Model\HomePage\HomePageBuilderAbstract $builder
                     */
                    $builder = new $obj();
                    $builder->setEntityManager($em);
                    $builder->setModuleRelatedRecords($value);

                    $homePageElements[$key] = $builder->recoverHomePageElements();
                }
            }

        } catch(NullException $e) {
            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => 0,
                'module_id'     => ModulesContainer::contenuti_id,
                'message'       => "Errore visualizzazione home page",
                'description'   => $e->getMessage(),
                'reference_id'  => 0,
                'type'          => 'error',
                'backend'       => 0,
            ));
        }

        $this->layout()->setVariables(array(
            'configuraitions'   => $configurations,
            'homepage'          => !empty($homePageElements) ? $homePageElements : null,
            'templatePartial'   => 'homepage/homepage.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}