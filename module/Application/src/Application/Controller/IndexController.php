<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Setup\Controller\SetupController;
use Zend\View\Model\ViewModel;

/**
 * Home page controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    /**
     * TODO: check if layout template exists!
     * @return array with viewModel object lets return an HTTP 200 status on ZfTool
     */
    public function indexAction()
    {
    	$setupController = new SetupController();
    	$setupObjectRecord = $setupController->getSetupRecord();
    	
    	$this->layout($setupObjectRecord['basiclayout']);
    	$this->layout()->setVariable("templateData", $setupObjectRecord);

    	return new ViewModel();
    }
}
