<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Application\Controller\Plugin\SetupManagerPlugin;

/**
 * @author Andrea Fiori
 * @since  27 December 2013
 */
abstract class SetupInitializerPluginAbstract extends AbstractPlugin
{
	protected $setupManagerPlugin, $route;

	abstract protected function getInput();
	
	/**
	 * @param SetupManagerPlugin $setupManagerPlugin
	 */
	public function __construct(SetupManagerPlugin $setupManagerPlugin)
	{
		$this->setupManagerPlugin = $setupManagerPlugin;
	}

	public function initializeSetupManager($input=null)
	{
		if (!$input) {
			$input = $this->getInput();
		}
		
		return $this->setupManagerPlugin->initialize($input);
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
	}
}