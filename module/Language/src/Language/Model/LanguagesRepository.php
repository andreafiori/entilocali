<?php

namespace Language\Model;

use Setup\Model\EntityRepositoryAbstract;
use Application\Entity\Channels;

class LanguagesRepository extends EntityRepositoryAbstract {

	protected $repository = 'Application\Entity\Languages';

	private $defaultLangFieldName, $defaultLanguage;

	private $allAvailableLanguages;

	/**
	 * set all available languages 
	 * @param Channels $channel
	 * @return array $record
	 */
	public function setAllAvailableLanguages(Channels $channel)
	{
		$this->allAvailableLanguages = $this->em->getRepository($this->repository)->findBy( array("active" => 1, "channel" => $channel) );
		return $this->allAvailableLanguages;
	}
	
	/**
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $abbreviation
	 */
	public function setDefaultLanguage($abbreviation)
	{
		if ( !$this->allAvailableLanguages ) {
			return false;
		}
		
		$this->setDefaultLangFieldName();
		
		$arrayCompare = array();
		$arrayCompare['active'] = 1;
		if ($abbreviation) {
			$arrayCompare['abbrev1'] = $abbreviation;
		} else {
			$arrayCompare[$this->getDefaultLangFieldName()] = 1;
		}
		
		foreach($this->allAvailableLanguages as $allAvailableLanguages)
		{
			$arrayAvailableLanguage = $this->getEntitySerializer()->toArray($allAvailableLanguages);
			$diff = array_diff($arrayCompare, $arrayAvailableLanguage);
			if ( empty($diff) ) {
				$this->defaultLanguage = $allAvailableLanguages;
				return $allAvailableLanguages;
			}
		}

		return false;
	}

	public function getDefaultLanguage()
	{
		return $this->defaultLanguage;
	}
		
	public function setDefaultLangFieldName()
	{
		if ($this->isOnBackend())
			$this->defaultLangFieldName = 'defaultlangAdmin';
		else
			$this->defaultLangFieldName = 'defaultlang';
	}

	public function getDefaultLangFieldName()
	{
		return $this->defaultLangFieldName;
	}
	
}