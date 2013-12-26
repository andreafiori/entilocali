<?php

namespace Config\Model;

use Setup\Model\EntityRepositoryAbstract;

class ConfigRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Config';
	
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