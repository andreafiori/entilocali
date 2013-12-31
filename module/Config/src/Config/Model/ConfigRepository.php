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
		if (!$this->getConfigurations()) return false;
		
		$configRecord = array();
		foreach($this->configurations as $configData)
		{
			$configRecord[$configData['name']] = $configData['value'];
		}
		$configRecord['projectdir'] = 'frontend/projects/'.$configRecord['frontendprojectdir'];
		$configRecord['frontendtemplate'] = $configRecord['frontendtemplate'] ? $configRecord['frontendtemplate'] : 'default/';
		$configRecord['basiclayout'] = $configRecord['projectdir'].'templates/'.$configRecord['frontendtemplate'].'layout.phtml';
		
		return $configRecord;
	}
	
	public function getConfigurations()
	{
		return $this->configurations;
	}
}