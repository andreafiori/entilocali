<?php

namespace Language\Model;

use Setup\Model\EntityRepositoryAbstract;
use Application\Entity\Channels;
use stdClass;

class LanguagesRepository extends EntityRepositoryAbstract {
	
	protected $repository = 'Application\Entity\Languages';
	
	private $defaultLangFieldName;
	
	private $defaultLanguage, $allAvailableLanguages;
	
	private $channelEntity;
	
	/**
	 * set all available languages 
	 * @param number $channel
	 * @return array $record
	 */
	public function setAllAvailableLanguages($channel = 1)
	{
		$this->setChannelEntity($channel);
		
		$this->allAvailableLanguages = $this->em->getRepository($this->repository)->findBy( array("active" => 1, "channel" => $this->getChannelEntity()) );
		
		return $this->allAvailableLanguages;
	}
	
	/**
	 * set channel entity for the query selection
	 * @param number $channel
	 */
	public function setChannelEntity($channel = 1)
	{
		$channelEntity = new Channels();
		$channelEntity->setId($channel);
		$this->channelEntity = $channelEntity;
	}
	
	public function getChannelEntity()
	{
		return $this->channelEntity;
	}
	
	/**
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $
	 */
	public function setDefaultLanguage($abbreviation)
	{
		if (!$this->allAvailableLanguages) return false;

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