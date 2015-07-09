<?php

namespace Admin\Controller\HomePage;

use ModelModule\Model\HomePage\HomePageControllerHelper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\HomePage\HomePageHelper;

/**
 * Home Page Management Controller
 */
class HomePageController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $lang = $this->layout()->getVariable('lang');

        try{
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

                /**
                 * @var \ModelModule\Model\HomePage\HomePageBuilderAbstract $builder
                 */
                $builder = new $obj();
                $builder->setEntityManager($em);
                $builder->setModuleRelatedRecords($value);

                $records  = $builder->recoverHomePageElements($value);

                $i = 0;
                foreach($records as &$record) {
                    $record = array_merge(
                        $record,
                        array(
                            'homepageId'    => $value[$i]['homepageId'],
                            'languageId'    => $value[$i]['languageId'],
                            'referenceId'   => $value[$i]['referenceId'],
                            'moduleName'    => $value[$i]['moduleName'],
                            'blockId'       => $value[$i]['blockId']
                        )
                    );
                    $i++;
                }

                $homePageElements[$key] = $records;
            }

            $this->layout()->setVariables(array(
                'configurations'    => $configurations,
                'records'           => !empty($homePageElements) ? $homePageElements : null,
                'templatePartial'   => 'homepage/homepage-manager.phtml',
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                    'messageType'       => 'warning',
                    'messageTitle'      => 'Problema verificato',
                    'messageText'       => $e->getMessage(),
                    'templatePartial'   => 'message.phtml'
                )
            );

        }

        $this->layout()->setTemplate($mainLayout);
    }
}
