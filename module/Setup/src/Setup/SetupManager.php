<?php

namespace Setup;

use Language\Model\LanguagesRepository,
	Config\Model\ConfigRepository,
	Language\Model\LanguagesLabelsRepository,
	Setup\EntitySerializer,
	Application\Entity\Channels,
	Application\Entity\Languages;

/**
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager extends SetupManagerAbstract {

    public function setSetupRecord()
    {
    	$this->setChannelEntity($this->input['channel']);
    	
    	$this->setLanguageRepository();
		$this->setLanguageEntity();
		$this->setLanguageLabels();
		
		return $this->setConfigRecord();
    }
	
	    private function setChannelEntity($channelId)
	    {
	    	$this->channelEntity = new Channels();
	    	$this->channelEntity->setId($channelId);
	    }
    
    public function getChannelEntity()
    {
    	return $this->channelEntity;
    }

	    private function setLanguageRepository()
	    {
	    	$this->languageRepository = new LanguagesRepository($this->em);
	    	$this->languageRepository->setEntitySerializer( new EntitySerializer($this->em) );
	    	$this->languageRepository->setIsOnBackend($this->input['isonbackend']);
	    	$this->languageRepository->setAllAvailableLanguages($this->channelEntity);
	    	$this->languageRepository->setDefaultLanguage($this->input['languageAbbreviation']);
	    }

    public function getLanguageRepository()
    {
    	return $this->languageRepository;
    }
    
    public function getSetupRecord()
    {
    	return $this->setupRecord;
    }

    	private function setLanguageEntity()
    	{
    		if (!$this->languageRepository->getDefaultLanguage()) {
    			return false;
    		}
    		
    		$this->languageEntity = new Languages();
    		$this->languageEntity->setId( $this->languageRepository->getDefaultLanguage()->getId() );
    		
    		return $this->languageEntity;
    	}
    	
    	private function setLanguageLabels()
    	{
    		$languagesLabelsRepository = new LanguagesLabelsRepository($this->em);
    		$this->languageLabels = $languagesLabelsRepository->getLabels(array("language" => $this->languageEntity));
    	}
    	
    	private function setConfigRecord()
    	{
    		$defaultLanguage = $this->languageRepository->getDefaultLanguage();
    		if (!$defaultLanguage) {
    			return false;
    		}
    		
    		$configRepository = new ConfigRepository($this->em);
    		$setupRecord = $configRepository->getConfigurations(
    				array(
    					"channel" => array($defaultLanguage->getChannel(), 0),
    					"isbackend" => $this->input['isbackend']
    				)
    		);
    		
    		$setupRecord['languageAllAvailable'] = $this->languageRepository->getAllAvailableLanguages();
    		$setupRecord['languageDefault'] = $defaultLanguage;
    		$setupRecord['languageLabels'] = $this->languageLabels;
    		
    		
    		return $this->setupRecord = array_filter($setupRecord);
    	}
}