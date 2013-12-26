<?php

namespace Config\Model;

use Setup\Model\EntityRepositoryAbstract;

/**
 * Config Entity Reposityory helper
 * @author Andrea Fiori
 * @since  24 December 2013
 */
class ConfigRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Config';
	
	/**
	 * 
	 * @param array $arraySearch
	 * @return array $configRecord
	 */
	public function getConfigurations($arraySearch)
	{
		$configurations = $this->getFindFromRepository($arraySearch);
		$configRecord = array();
		foreach($configurations as $configData)
		{
			$configRecord[$configData['name']] = $configData['value'];
		}

		$configRecord['projectdir'] = 'frontend/projects/'.$configRecord['frontendprojectdir'];
		if (!isset($configRecord['frontendtemplate']))
			$configRecord['frontendtemplate'] = 'default/';
		$configRecord['basiclayout'] = $configRecord['projectdir'].'templates/'.$configRecord['frontendtemplate'].'layout.phtml';
		
		return $configRecord;
	}
}