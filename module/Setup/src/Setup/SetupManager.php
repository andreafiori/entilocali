<?php

namespace Setup;

use Language\Model\LanguagesRepository;
use	Config\Model\ConfigRepository;
use	Language\Model\LanguagesLabelsRepository;

/**
 * Merge Config and Language selection data to get app configuration setup record
 * TODO: 
 * 		detect channel and get the id to language selections
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager {

	private $input;
	private $entityManager;
	
	private $channelId;
	
	private $languageRepository;
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
	
	public function setChannelId()
	{
		$this->channelId = 1;
	}
	
    public function generateSetupRecord()
    {
    	$this->languageRepository = new LanguagesRepository( $this->getEntityManager() );
	    $this->languageRepository->setAllAvailableLanguages(1); // passing the channel ID
	    $this->languageRepository->setDefaultLanguage($this->input['languageAbbreviation']);

	    $defaultLanguage = $this->languageRepository->getDefaultLanguage();
		$languagesLabelsRepository = new LanguagesLabelsRepository($this->getEntityManager());
   		$this->languageLabelsRepository = $languagesLabelsRepository->getLabels( array("language" => $defaultLanguage['id']) );

		$defaultLanguage = $this->getLanguageRepository()->getDefaultLanguage();

   		if (!$defaultLanguage) return false;

   		$configRepository = new ConfigRepository($this->getEntityManager());
    	$configRepository->setConfigurations(
    			array(
    				"channel" => array($this->channelId ? $this->channelId : 1, 0),
    				"isbackend" => $this->input['isbackend']
    			)
    	);
    	$setupRecord = $configRepository->getConfigRecord();
    	$setupRecord['languageAllAvailable'] = $this->getLanguageRepository()->getAllAvailableLanguages();
    	$setupRecord['languageDefault'] = $defaultLanguage;
    	$setupRecord['languageLabels'] = $this->languageLabels;
    	
    	return $this->setupRecord = array_filter($setupRecord);
    }

	public function getChannelId()
    {
    	return $this->channelId;
    }

    public function getInput($key=null)
    {
    	if ($key) return $this->input[$key];
    	return $this->input;
    }

    public function getEntityManager()
    {
    	return $this->entityManager;
    }
    	
    public function getLanguageRepository()
    {
    	return $this->languageRepository;
    }
}