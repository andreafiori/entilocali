<?php

namespace Config\Model;

use Setup\QueryMakerAbstract;
use Setup\NullException;

/**
 * Config Entity Reposityory Helper
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class ConfigRepository extends QueryMakerAbstract
{
	protected $repository = 'Application\Entity\Config';
	
	private $configurations;
	
	private $configRecord = array();
	
	/**
	 * @param array $arraySearch
	 * @return array $configRecord
	 */
	public function setConfigurations($arraySearch = null, array $orderBy = null, $limit = null, $offset = null)
	{
		$this->configurations = $this->convertArrayOfObjectToArray( $this->getFindFromRepository($arraySearch, $orderBy, $limit, $offset) );

		return $this->configurations;
	}
	
	/**
	 * Set configuration name => value from the record select on db
	 * @throws \Setup\NullException
	 */
	public function initConfigRecord()
	{
		if (!$this->getConfigurations()) {
			throw new NullException('Configurations are not set');
		}
		
		foreach($this->getConfigurations() as $configData) {
			$this->configRecord[$configData['name']] = $configData['value'];
		}
		
		return $this->configRecord;
	}

	public function getConfigRecord($key = null)
	{
		if ($key and isset($this->configRecord[$key])) {
			return $this->configRecord[$key];
		}
		
		return $this->configRecord;
	}
	
	public function getConfigurations()
	{
		return $this->configurations;
	}
}