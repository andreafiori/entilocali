<?php

namespace Admin\Controller\Configurations;

use Application\Controller\SetupAbstractController;

class ConfigurationsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    }
}
