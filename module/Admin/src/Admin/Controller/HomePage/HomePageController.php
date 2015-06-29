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

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Insert an element via GET, using only requested data
     */
    public function insertAction()
    {

    }

    /**
     * Delete element from home page
     *
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageControllerHelper();
        $helper->setConnection($em->getConnection());
        $helper->deleteFromHomeById($id);

        $referer = $this->getRequest()->getHeader('Referer');
        if ( is_object($referer) ) {
            return $this->redirect()->toUrl( $referer->getUri() );
        }

        return $this->redirect()->toRoute('main');
    }
}