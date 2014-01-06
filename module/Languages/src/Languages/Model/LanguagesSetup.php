<?php

namespace Languages\Model;

use Setup\QueryMakerAbstract;

class LanguagesSetup extends QueryMakerAbstract {

	private $defaultLangFieldName;
	private $defaultLanguage;
	private $allAvailableLanguages;
	
	private $isOnBackend;

	public function isOnBackend()
	{
		return $this->isOnBackend;
	}

	public function setIsOnBackend($isOnBackend)
	{
		$this->isOnBackend = $isOnBackend;
	}

	/**
	 * Set all available languages
	 * @param Channels $channel
	 * @return array $record
	 */
	public function setAllAvailableLanguages($channelId = 1)
	{
		$query = $this->getEntityManager()->createQuery("SELECT l.id, l.abbreviation1, l.isdefault, l.isdefaultBackend, l.active FROM Application\\Entity\\Languages l WHERE l.active = 1 AND l.channel = :channel ");
		$query->setParameter('channel', $channelId);
		
		$this->allAvailableLanguages = $query->getResult();
		
		return $this->allAvailableLanguages;
	}

	/**
	 * @param string $abbreviation
	 * @return \Application\Entity\Language $abbreviation
	 */
	public function setDefaultLanguage($abbreviation)
	{
		if ( !$this->getAllAvailableLanguages() ) {
			return false;
		}
		
		if ( $this->isOnBackend() ) {
			$this->defaultLangFieldName = 'defaultlangAdmin';
		} else {
			$this->defaultLangFieldName = 'defaultlang';
		}
		
		$arrayCompare = array();
		$arrayCompare['active'] = 1;
		if ($abbreviation) {
			$arrayCompare['abbreviation1'] = $abbreviation;
		} else {
			$arrayCompare[$this->defaultLangFieldName] = 1;
		}
		
		foreach($this->getAllAvailableLanguages() as $allAvailableLanguages)
		{
			$diff = array_diff($arrayCompare, $allAvailableLanguages);
			if ( empty($diff) )
			{
				$this->defaultLanguage = $allAvailableLanguages;
				return $allAvailableLanguages;
			}
		}

		return false;
	}

	public function getAllAvailableLanguages()
	{
		return $this->allAvailableLanguages;
	}

	/**
	 * @return Languages $defaultLanguage
	 */
	public function getDefaultLanguage()
	{
		return $this->defaultLanguage;
	}

	public function getLanguageAbbreviationFromDefaultLanguage()
	{
		$defaultLanguage = $this->getDefaultLanguage();
		if (is_object($defaultLanguage)) {
			return $defaultLanguage->getAbbreviation1();
		}
	}
}