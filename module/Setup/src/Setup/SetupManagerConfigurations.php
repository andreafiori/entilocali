<?php

namespace Setup;

use	Config\Model\ConfigRepository;

class SetupManagerConfigurations extends SetupManagerAbstract
{
	private $configurations, $configRepository;
	
	/**
	 * 
	 * @param ConfigRepository $configRepository
	 * @return ConfigRepository
	 */
	public function setConfigRepository(ConfigRepository $configRepository)
	{
		$this->configRepository = $configRepository;
	
		return $this->configRepository;
	}
	
	/**
	 * 
	 * @param array $input
	 * @throws NullException
	 */
	public function setConfigurations(array $input)
	{
		if ( !$this->getConfigRepository() ) {
			throw new NullException('Config Repository is not set');
		}
		
		$this->configurations = $this->getConfigRepository()->setConfigurations( $input );
	}
	
	/**
	 * 
	 * @param string $key
	 */
	public function getConfigurations($key=null)
	{
		if (isset($this->configurations[$key])) {
			return $this->configurations[$key];
		}
		
		return $this->configurations;
	}

	/**
	 * @return ConfigRepository
	 */
	public function getConfigRepository()
	{
		return $this->configRepository;
	}
	
}