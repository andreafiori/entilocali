<?php

namespace Setup;

use	Config\Model\ConfigRepository;
use Languages\Model\LanguagesSetup;
use	Languages\Model\LanguagesLabelsRepository;

/**
 * Merge Config and Language selection data to get app configuration setup record
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager {

	private $input;
	private $entityManager;
	
	private $channelId;
	private $configRepository;
	
	private $languagesSetup;
	private $languageId;
	private $languageAbbreviation;
	private $defaultLanguage;
	
	private $languagesLabels;
	private $languagesLabelsRepository;
	
	public function __construct(array $input)
	{
		$this->input = $input;
	}
	
	public function getInput($key = null)
	{
		if ($key) return $this->input[$key];
		return $this->input;
	}
	
	public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * TODO: detect channel and get the id to language selections
	 */
	public function setChannelId()
	{
		$this->channelId = 1;
		
		return $this->channelId;
	}

	public function getChannelId()
	{
		return $this->channelId;
	}
	
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
	}
	
	/**
	 * 
	 * @param ConfigRepository $configRepository
	 * @return ConfigRepository
	 */
	public function setConfigRepository(ConfigRepository $configRepository)
	{
		$this->configRepository = $configRepository;

		return $this->configRepository;
	}
	
	/**
	 * @throws NullException
	 */
	public function setConfigurations()
	{
		if ( !$this->getConfigRepository() ) {
			throw new NullException('Config Repository is not set');
		}
		
		$this->getConfigRepository()->setConfigurations(
				array(
						"channel" 	=> array($this->getChannelId() ? $this->getChannelId() : 1, 0),
						"isbackend" => $this->getInput('isbackend')
				)
		);
	}
	
	/**
	 * @return ConfigRepository
	 */
	public function getConfigRepository()
	{
		return $this->configRepository;
	}
    
	/**
	 * @param LanguagesLabelsRepository $languagesLabelsRepository
	 */
    public function setLanguagesLabelsRepository(LanguagesLabelsRepository $languagesLabelsRepository)
    {
    	$this->languageLabelsRepository = $languagesLabelsRepository;
    }
    
    public function getLanguageLabelsRepository()
    {
    	return $this->languageLabelsRepository;
    }

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
    	$this->defaultLanguage = $this->getLanguageSetup()->getDefaultLanguage();
    }
    
    public function setLanguagesSetup(LanguagesSetup $languagesSetup)
    {
    	$this->languagesSetup = $languagesSetup;
    	$this->languagesSetup->setAllAvailableLanguages($this->getChannelId());
    	$this->languagesSetup->setDefaultLanguage($this->getInput('languageAbbreviation'));
    }
    
    public function getDefaultLanguage($key = null)
    {
    	if ($key) {
    		return $this->defaultLanguage[$key];
    	}
    	
    	return $this->defaultLanguage;
    }

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

    public function getEntityManager()
    {
    	return $this->entityManager;
    }
}