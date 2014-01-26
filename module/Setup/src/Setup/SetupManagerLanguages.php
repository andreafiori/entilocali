<?php

namespace Setup;

use Languages\Model\LanguagesSetup;

class SetupManagerLanguages extends SetupManagerAbstract
{
	protected $languageId, $languageAbbreviation, $defaultLanguage;

	protected $languagesSetup;
	
	protected $languagesLabelsRepository;
	protected $languagesLabels;

	public function setLanguagesSetup(LanguagesSetup $languagesSetup)
	{
		$this->languagesSetup = $languagesSetup;
	}
	
	public function setAllAvailableLanguages($channelId)
	{
		$this->getLanguageSetup()->setAllAvailableLanguages($channelId);
	}
	
	public function setDefaultLanguage($languageAbbreviation)
	{
		$this->getLanguageSetup()->setDefaultLanguage($languageAbbreviation);		
	}
	
	/**
	 * @return LanguagesSetup
	 */
	public function getLanguageSetup()
	{
		return $this->languagesSetup;
	}

	public function getDefaultLanguage($key = null)
	{
		if (!$this->getLanguageSetup()) {
			throw new NullException('Language Setup is not set');
		}
		
		return $this->getLanguageSetup()->getDefaultLanguage($key);
	}
	
	
	// TODO: remove unused methods
	public function setLanguageId($id)
	{
		$this->languageId = (int) $id;
	}
	
	public function getLanguageId()
	{
		return $this->languageId ? $this->languageId : 1;
	}
	
	// TODO: move this on languages Setup !?
	public function setLanguageIdFromDefaultLanguage()
	{
		$this->languageId = $this->getDefaultLanguage('id');

		return $this->languageId;
	}
	
	/**
	 *
	 * @param unknown $lang
	 */
	public function setLanguageAbbreviation($lang)
	{
		$this->languageAbbreviation = $lang;
	}
	
	public function setLanguageAbbreviationFromDefaultLanguage()
	{
		$this->languageAbbreviation = $this->getDefaultLanguage('abbreviation1');
	
		return $this->languageAbbreviation;
	}
	
	public function getLanguageAbbreviation()
	{
		return $this->languageAbbreviation;
	}
}