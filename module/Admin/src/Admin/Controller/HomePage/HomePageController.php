<?php

namespace Admin\Controller\HomePage;

use ModelModule\Model\HomePage\HomePageControllerHelper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use Application\Controller\SetupAbstractController;

class HomePageController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageControllerHelper();
        $wrapper = $helper->recoverWrapper(
            new HomePageGetterWrapper(new HomePageGetter($em)),
            array('orderBy' => 'homePageBlocks.position ASC')
        );

        $records = $wrapper->getRecords();

        $this->layout()->setVariables(array(
            'records'         => $records,
            'templatePartial' => 'homepage/homepage-manager.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}