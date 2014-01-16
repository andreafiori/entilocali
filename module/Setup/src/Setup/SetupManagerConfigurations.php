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
	 * @throws NullException
	 */
	public function setConfigurations()
	{
		if ( !$this->getConfigRepository() ) {
			throw new NullException('Config Repository is not set');
		}
		
		// this is input must be injected... 
		$this->configurations = $this->getConfigRepository()->setConfigurations(
				array(
					"channel" 	=> array($this->getChannelId() ? $this->getChannelId() : 1, 0),
					"isbackend" => $this->getInput('isbackend')
				)
		);
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