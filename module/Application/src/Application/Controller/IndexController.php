<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Setup\Controller\SetupController;

/**
 * Home page controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{	
    /**
     * @return array with viewModel object lets return an HTTP 200 status on ZfTool
     */
    public function indexAction()
    {    	
		$setup = new SetupController();
    	$this->layout('frontend/projects/fossobandito/templates/default/layout.phtml');
    	return array("setupRecord" => $setup->getSetupRecord() );
    }
}
