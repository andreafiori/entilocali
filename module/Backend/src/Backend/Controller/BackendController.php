<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupController = new SetupManager($this);
    	$setupController->setInput( array( 'channel' => 1, 'isbackend' => 1 ) );
    	$setupObjectRecord = $setupController->setSetupRecord();
		
        $this->layout()->setTemplate('backend/backend/index');
        $this->layout()->setVariable("templateData", $setupObjectRecord);

        return new ViewModel();
    }
}