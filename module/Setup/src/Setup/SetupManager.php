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
	
	private $languagesSetup;
	private $defaultLanguage;
	private $languageLabelsRepository;
	private $setupRecord;

	public function __construct(array $input)
	{
		$this->input = $input;
	
		return $input;
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
		return $this->channelId;;
	}

	/**
	 * @return array $setupRecord
	 */
    public function generateSetupRecord()
    {
    	$defaultLanguage = $this->setDefaultLanguage();
	    
		$this->languageLabelsRepository = new LanguagesLabelsRepository($this->getEntityManager());
   		$this->languageLabels = $this->languageLabelsRepository->getLabels(
   					array("language" => $this->getDefaultLanguage('id')) 
   		);

   		$configRepository = new ConfigRepository($this->getEntityManager());
    	$configRepository->setConfigurations(
    			array(
    				"channel" => array($this->channelId ? $this->channelId : 1, 0),
    				"isbackend" => $this->input['isbackend']
    			)
    	);
    	$setupRecord = $configRepository->getConfigRecord();
    	$setupRecord['languageAllAvailable'] = $this->getLanguageSetup()->getAllAvailableLanguages();
    	$setupRecord['languageDefault'] = $defaultLanguage;
    	$setupRecord['languageLabels'] = $this->languageLabels;
    	
    	return $this->setupRecord = array_filter($setupRecord);
    }
    
    public function setDefaultLanguage()
    {
    	$this->languagesSetup = new LanguagesSetup( $this->getEntityManager() );
    	$this->languagesSetup->setAllAvailableLanguages($this->getChannelId());
    	$this->languagesSetup->setDefaultLanguage($this->getInput('languageAbbreviation'));

    	$this->defaultLanguage = $this->getLanguageSetup()->getDefaultLanguage();
    	
    	return $this->defaultLanguage;
    }
    
    public function getDefaultLanguage($key=null)
    {
    	if ($key) {
    		return $this->defaultLanguage[$key];
    	}
    	return $this->defaultLanguage;
    }

    public function getInput($key = null)
    {
    	if ($key) return $this->input[$key];
    	return $this->input;
    }

    public function getEntityManager()
    {
    	return $this->entityManager;
    }

    public function getLanguageSetup()
    {
    	return $this->languagesSetup;
    }
    
    public function getSetupRecord($key = null)
    {
    	if ($key) return $this->setupRecord[$key];
    	return $this->setupRecord;    	
    }
}