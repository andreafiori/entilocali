<?php

namespace Setup;

use Language\Model\LanguagesRepository;
use	Config\Model\ConfigRepository;
use	Language\Model\LanguagesLabelsRepository;

/**
 * Merge Config and Language selection data to get app configuration setup record
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager {

	private $input;
	private $entityManager;
	
	private $channelId;
	
	private $language;
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
	 * TODO: 
  			detect channel and get the id to language selections
	 */
	public function setChannelId()
	{
		$this->channelId = 1;
	}

	public function getChannelId()
	{
		if ($this->channelId) {
			return $this->channelId;
		}
		return 1;
	}

	/**
	 * TODO: move all method calls into a new single class and test them to call 1 by 1
	 * @return boolean|multitype:
	 */
    public function generateSetupRecord()
    {
    	$this->language = new LanguagesRepository( $this->getEntityManager() );
	    $this->language->setAllAvailableLanguages($this->getChannelId());
	    $this->language->setDefaultLanguage($this->input['languageAbbreviation']);

	    $defaultLanguage = $this->language->getDefaultLanguage();
	    
		$this->languageLabelsRepository = new LanguagesLabelsRepository($this->getEntityManager());
   		$this->languageLabels = $this->languageLabelsRepository->getLabels( array("language" => $defaultLanguage['id']) );

		$defaultLanguage = $this->getlanguage()->getDefaultLanguage();

   		if (!$defaultLanguage) return false;

   		$configRepository = new ConfigRepository($this->getEntityManager());
    	$configRepository->setConfigurations(
    			array(
    				"channel" => array($this->channelId ? $this->channelId : 1, 0),
    				"isbackend" => $this->input['isbackend']
    			)
    	);
    	$setupRecord = $configRepository->getConfigRecord();
    	$setupRecord['languageAllAvailable'] = $this->getLanguage()->getAllAvailableLanguages();
    	$setupRecord['languageDefault'] = $defaultLanguage;
    	$setupRecord['languageLabels'] = $this->languageLabels;
    	
    	return $this->setupRecord = array_filter($setupRecord);
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

    public function getLanguage()
    {
    	return $this->language;
    }
    
    public function getSetupRecord($key = null)
    {
    	if ($key) return $this->setupRecord[$key];
    	return $this->setupRecord;    	
    }
}