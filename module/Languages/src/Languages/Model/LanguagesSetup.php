<?php

namespace Languages\Model;

use Setup\NullException;
use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class LanguagesSetup
{
	private $defaultLangFieldName;
	
	private $defaultLanguage;
	
	private $allAvailableLanguages;
	
	private $isOnBackend;
	
	private $setupManager;
	
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function isOnBackend()
	{
		return $this->isOnBackend;
	}

	public function setIsOnBackend($isOnBackend = 0)
	{
		$this->isOnBackend = $isOnBackend;
		
		if ($this->isOnBackend) {
			$this->defaultLangFieldName = 'defaultlangAdmin';
		} else {
			$this->defaultLangFieldName = 'defaultlang';
		}
	}

	/**
	 * @param Channels $channel
	 * @return array $record
	 */
	public function setAllAvailableLanguages()
	{
		$languagesQueryBuilder = new LanguagesQueryBuilder();
		$languagesQueryBuilder->setSetupManager($this->setupManager);
		$languagesQueryBuilder->setBasicBindParameters();
		
		$this->allAvailableLanguages = $languagesQueryBuilder->getSelectResult();
		
		return $this->allAvailableLanguages;
	}

	public function setDefaultLanguage($abbreviation)
	{
		if ( !$this->getAllAvailableLanguages() ) {
			throw new NullException('All Available Languages are not set');
			return false;
		}

		if (!$this->defaultLangFieldName) {
			$this->setIsOnBackend();
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
			if (count($arrayCompare) == count($allAvailableLanguages)) {
				$diff = array_diff($arrayCompare, $allAvailableLanguages);
				
				if ( empty($diff) ) {
					$this->defaultLanguage = $allAvailableLanguages;
					return $this->defaultLanguage;
				}
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
	public function getDefaultLanguage($key=null)
	{
		if ($key) {
			return $this->defaultLanguage[$key];
		}
		
		return $this->defaultLanguage;
	}

	public function getLanguageAbbreviationFromDefaultLanguage()
	{
		if ( is_array($this->getDefaultLanguage()) ) {
			return $this->getDefaultLanguage('abbreviation1');
		}
	}
}