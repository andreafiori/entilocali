<?php

namespace Admin\Controller\HomePage;

use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use Application\Controller\SetupAbstractController;

class HomePageController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new HomePageGetterWrapper(new HomePageGetter($em));
        $wrapper->setInput(array(
            'orderBy' => 'homePageBlocks.position ASC'
        ));
        $wrapper->setupQueryBuilder();

        $this->layout()->setVariables(array(
            'records'         => $wrapper->getRecords(),
            'templatePartial' => 'homepage/homepage-manager.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}