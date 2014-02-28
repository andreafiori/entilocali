<?php

namespace Setup;

use Config\Model\ConfigQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class SetupManagerConfigurations extends SetupManagerAbstract
{
	private $configQueryBuilder;
	
	private $configurations;
	
	/**
	 * @param ConfigQueryBuilder $configRepository
	 * @return ConfigQueryBuilder
	 */
	public function setConfigQueryBuilder(ConfigQueryBuilder $configQueryBuilder)
	{
		$this->configQueryBuilder = $configQueryBuilder;
	
		return $this->configQueryBuilder;
	}

	public function setConfigurations()
	{
		$this->configQueryBuilder->setBasicBindParameters();
		
		$this->configurations = $this->configQueryBuilder->getSelectResult();
		
		$configurations = array();
		foreach($this->configurations as $config):
			if ( isset($config['name']) and isset($config['value']) ):
				$configurations[$config['name']] = $config['value'];
			endif;
		endforeach;
		
		$this->configurations = $configurations;
		
		return $this->configurations;
	}
	
	/**
	 * @param string $key
	 */
	public function getConfigurations($key = null)
	{
		if ( isset($this->configurations[$key]) ) {
			return $this->configurations[$key];
		}
		
		return $this->configurations;
	}

	/**
	 * @return ConfigRepository
	 */
	public function getConfigQueryBuilder()
	{
		return $this->configQueryBuilder;
	}
}