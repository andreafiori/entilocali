<?php

namespace Admin\Controller\Migrazione;

use Application\Controller\SetupAbstractController;

/**
 * Migrazione Controller Index
 */
class MigrazioneController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $lang = $this->layout()->getVariable('lang');

        $this->layout()->setVariables(array(
            'configurations'    => $configurations,
            'templatePartial'   => 'migrazione/migrazione.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}
