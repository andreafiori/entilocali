<?php

namespace Language\Model;

use Setup\Model\EntityRepositoryAbstract;

class LanguagesRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Languages';
	
	private $defaultLanguage, $defaultLangFieldName;
	
	private $allAvailableLanguages;
	
	private $channelId;
	
	/**
	 * set all available languages 
	 * @param number $channel
	 * @return array $record
	 */
	public function setAllAvailableLanguages($channel = 1)
	{
		$record = $this->em->getRepository($this->repository)->findBy( array("active" => 1, "channelId" => $channel) );
		$record = $this->convertObjectToArray($record);
		$this->allAvailableLanguages = $record;
		$this->channelId = $channel; var_dump($record);
		return $record;
	}
	
	/**
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $objLang 
	 */
	public function setDefaultLanguage($abbreviation)
	{
		if (!$this->allAvailableLanguages) return false;
			
		if ($this->isOnBackend())
			$this->defaultLangFieldName = 'defaultlangAdmin';
		else
			$this->defaultLangFieldName = 'defaultlang';
		
		$arrayCompare = array('active' => 1);
		if ($abbreviation)
			$arrayCompare['abbrev1'] = $abbreviation;
		else
			$arrayCompare[$this->defaultLangFieldName] = 1;
		
		foreach($this->allAvailableLanguages as $allAvailableLanguages)
		{
			$arrayDiff = array_diff($arrayCompare, $allAvailableLanguages);
			if ( empty($arrayDiff) )
			{
				return $allAvailableLanguages;
			}
		}
		return false;
	}
	
	public function getDefaultLanguage()
	{
		return $this->defaultLanguage;
	}
		
		protected function setDefaultLangFieldName()
		{
			if ($this->isOnBackend())
				$this->defaultLangFieldName = 'defaultlangAdmin';
			else
				$this->defaultLangFieldName = 'defaultlang';
		}
	
}