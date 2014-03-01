<?php

namespace Setup;

use Languages\Model\LanguagesSetup;

/**
 * @author Andrea Fiori
 * @since  24 January 2014
 */
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
	
		return ;
	}
	
	public function setDefaultLanguage($languageAbbreviation)
	{
		$this->getLanguageSetup()->setDefaultLanguage($languageAbbreviation);
		
		return $this->getAllAvailableLanguages();
	}
	
	/**
	 * @return LanguagesSetup
	 */
	public function getLanguageSetup()
	{
		return $this->languagesSetup;
	}
	
	public function getAllAvailableLanguages()
	{
		return $this->getLanguageSetup()->getAllAvailableLanguages();
	}

	public function getDefaultLanguage($key = null)
	{
		if ( !$this->getLanguageSetup() ) {
			throw new NullException('Language Setup is not set');
		}
		
		return $this->getLanguageSetup()->getDefaultLanguage($key);
	}
	
	public function setLanguageId($id)
	{
		$this->languageId = (int) $id;
	}
	
	public function getLanguageId()
	{
		return $this->languageId ? $this->languageId : 1;
	}
	
	public function setLanguageIdFromDefaultLanguage()
	{
		$this->languageId = $this->getDefaultLanguage('id');

		return $this->languageId;
	}
	
	/**
	 * @param string $lang
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