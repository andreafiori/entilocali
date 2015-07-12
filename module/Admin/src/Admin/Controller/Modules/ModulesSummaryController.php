<?php

namespace Admin\Controller\Modules;

use Application\Controller\SetupAbstractController;

/**
 * Module list to enable \ disable single module\s
 */
class ModulesSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setVariables(array(
            'templatePartial' => 'modules/modules-management.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}