<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * SetupInitializerAbstractPlugin
 * @author Andrea Fiori
 * @since  27 December 2013
 */
abstract class SetupInitializerAbstractPlugin extends AbstractPlugin
{
	protected $setupManagerPlugin, $route;

	abstract protected function getInput();

	public function __construct()
	{
		$this->setupManagerPlugin = new SetupManagerPlugin();
	}

	public function initializeSetupManager()
	{
		return $this->setupManagerPlugin->initialize( $this->getInput() );
	}
	
	/**
	 * @param array $route
	 */
	public function setRoute(array $route)
	{
		$this->route = $route;
		
		return $this->route;
	}
	
	/**
	 * @param string $key
	 * @return array or string
	 */
	public function getRoute($key)
	{
		if ( isset($this->route[$key]) ) {
			return $this->route[$key];
		}
		
		return $this->route;
	}
}