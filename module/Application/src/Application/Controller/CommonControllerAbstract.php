<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Setup\SetupManager;

/**
 * Common Controller Abstract Both for Frontend and Backend
 * @author Andrea Fiori
 * @since  07 February 2014
 */
abstract class CommonControllerAbstract extends AbstractActionController
{
	protected $setupManager;
	
	abstract protected function generateSetupManagerFromInitializerPlugin();
	
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