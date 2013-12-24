<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupController = new SetupManager($this);
    	$setupController->setObjectManager( $this->getServiceLocator()->get('entityManagerService') );
    	$setupObjectRecord = $setupController->setSetupRecord();

    	$this->layout($setupObjectRecord['basiclayout']);
    	$this->layout()->setVariable("templateData", $setupObjectRecord);

    	return new ViewModel();
    }
}
