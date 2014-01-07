<?php

namespace Config\Model;

use Setup\QueryMakerAbstract;

/**
 * Config Entity Reposityory helper
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class ConfigRepository extends QueryMakerAbstract {

	protected $repository = 'Application\Entity\Config';
	
	private $configurations;
	
	/**
	 * 
	 * @param array $arraySearch
	 * @return array $configRecord
	 */
	public function setConfigurations($arraySearch = null, array $orderBy = null, $limit = null, $offset = null)
	{
		$this->configurations = $this->convertArrayOfObjectToArray( $this->getFindFromRepository($arraySearch, $orderBy, $limit, $offset) );
		
		return $this->configurations;
	}
	
	public function getConfigRecord()
	{		
		$configRecord = array();
		foreach($this->configurations as $configData)
		{
			$configRecord[$configData['name']] = $configData['value'];
		}
			
		return $configRecord;
	}
	
	public function getConfigurations()
	{
		return $this->configurations;
	}
}