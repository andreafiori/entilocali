<?php

namespace Application\Controller;

use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use ModelModule\Model\HomePage\HomePageHelper;
use ModelModule\Model\NullException;

class IndexController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang = $this->layout()->getVariable('lang');

        try {

            $helper = new HomePageHelper();
            $helper->setHomePageGetterWrapper( new HomePageGetterWrapper(new HomePageGetter($em)) );
            $helper->setupHomePageRecords(array(
                'onlyActiveModules'     => 1,
                'orderBy'               => 'homePageBlocks.position ASC',
                'languageAbbreviation'  => $lang
            ));
            $helper->gatherReferenceIds();
            $helper->checkHomePageRecords();

            $sortedHomePageRecords = $helper->getHomePageRecords();

            $helper->checkClassMapFromRecords();

            $homePageElements = array();
            foreach($sortedHomePageRecords as $key => $value) {
                $obj = $helper->recoverClassMapKey($key);

                /**
                 * @var \ModelModule\Model\HomePage\HomePageBuilderAbstract $builder
                 */
                $builder = new $obj();
                $builder->setEntityManager($em);
                $builder->setModuleRelatedRecords($value);

                $homePageElements[$key] = $builder->recoverHomePageElements();
            }

        } catch(NullException $e) {

        }

        $this->layout()->setVariables( array(
            'homepage'          => !empty($homePageElements) ? $homePageElements : null,
            'templatePartial'   => 'homepage/homepage.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}