<?php

namespace Setup;

use	Config\Model\ConfigRepository;

class SetupManagerConfigurations extends SetupManagerAbstract
{
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
	
		$this->getConfigRepository()->setConfigurations(
				array(
						"channel" 	=> array($this->getChannelId() ? $this->getChannelId() : 1, 0),
						"isbackend" => $this->getInput('isbackend')
				)
		);
	}

	/**
	 * @return ConfigRepository
	 */
	public function getConfigRepository()
	{
		return $this->configRepository;
	}
	
}