<?php

namespace Application\Controller;

use Setup\SetupManager;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\Plugin\FrontendSetupInitializerPlugin;
use Application\Controller\Plugin\SetupManagerPlugin;

/**
 * @author Andrea Fiori
 * @since  02 February 2014
 */
abstract class FrontendControllerAbstract extends AbstractActionController
{
	/**
	 * @return SetupManager
	 */
	protected function generateSetupManagerFromInitializerPlugin()
	{
    	$fsip = new FrontendSetupInitializerPlugin( new SetupManagerPlugin() );
    	
    	$fsip->setRoute( $this->params()->fromRoute() );
    	
    	return $fsip->initializeSetupManager();
	}
}
