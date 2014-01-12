<?php

namespace Setup;

use Languages\Model\LanguagesSetup;
use	Languages\Model\LanguagesLabelsRepository;

class SetupManagerLanguages extends SetupManagerAbstract {
	
	protected $languageId;
	protected $languageAbbreviation;
	protected $defaultLanguage;
	
	protected $languagesSetup;
	protected $languagesLabels;
	protected $languagesLabelsRepository;
	
	public function setLanguageId($id)
	{
		$this->languageId = (int) $id;
	}
	
	public function getLanguageId()
	{
		if (!$this->languageId) return 1;
		return $this->languageId;
	}
	
	public function setLanguageIdFromDefaultLanguage()
	{
		$this->languageId = $this->getDefaultLanguage('id');
	
		return $this->languageId;
	}
	
	/**
	 * @param LanguagesLabelsRepository $languagesLabelsRepository
	 */
	public function setLanguagesLabelsRepository(LanguagesLabelsRepository $languagesLabelsRepository)
	{
		$this->languageLabelsRepository = $languagesLabelsRepository;
			
		return $this->languageLabelsRepository;
	}
	
	public function getLanguageLabelsRepository()
	{
		return $this->languageLabelsRepository;
	}
	
	/**
	 *
	 * @throws NullException
	 */
	public function setLanguagesLabels()
	{
		if (!$this->getLanguageLabelsRepository()) {
			throw new NullException('Language Labels Repository is not set');
		}
			
		$this->languagesLabels = $this->getLanguageLabelsRepository()->getLabels(
				array("language" => $this->getDefaultLanguage('id') ? $this->getDefaultLanguage('id') : 1 )
		);
	}
	
	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
	
	public function setDefaultLanguage()
	{
		if ( !$this->getLanguageSetup() ) {
			throw new NullException('LanguagesSetup is not set');
		}
			
		$this->defaultLanguage = $this->getLanguageSetup()->getDefaultLanguage();
	}
	
	public function setLanguagesSetup(LanguagesSetup $languagesSetup)
	{
		$this->languagesSetup = $languagesSetup;
		$this->languagesSetup->setAllAvailableLanguages(1); // $this->getChannelId()
		$this->languagesSetup->setDefaultLanguage($this->getInput('languageAbbreviation'));
	}
	
	public function getDefaultLanguage($key = null)
	{
		if ($key) {
			return $this->defaultLanguage[$key];
		}
			
		return $this->defaultLanguage;
	}
	
	/**
	 * 
	 * @return LanguagesSetup
	 */
	public function getLanguageSetup()
	{
		return $this->languagesSetup;
	}
	
	public function seLanguageAbbreviation($lang)
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