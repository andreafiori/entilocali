<?php

namespace Application\Controller;

use Setup\SetupManager;
use Backend\Controller\Plugin\BackendSetupInitializerPlugin;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\Plugin\SetupManagerPlugin;

/**
 * Common Controller Abstract used both for Frontend and backend
 * @author Andrea Fiori
 * @since  07 February 2014
 */
abstract class CommonControllerAbstract extends AbstractActionController
{
	protected $setupManager;
	
	/**
	 * @return SetupManager
	 */
	protected function generateSetupManagerFromInitializerPlugin()
	{
		$bsip = new BackendSetupInitializerPlugin( new SetupManagerPlugin() );
		
		$bsip->setRoute( $this->params()->fromRoute() );

		return $bsip->initializeSetupManager();
	}
	
	protected function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	/**
	 * @return SetupManager
	 */
	protected function getSetupManager()
	{
		return $this->setupManager;
	}
}