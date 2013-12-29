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
class SetupManager {

	private $input;
	private $em;
	
	private $channelEntity, $languageEntity;
	private $languageRepository;
	private $languageLabels;
	
	public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->em = $entityManager;
	}

	/**
	 * Set input parameters (Frontend or Backend)
	 * @param array $input
	 * @return array
	 */
	public function setInput($input)
	{
		if (is_array($input)) {
			$this->input = $input;
		}
		
		return $input;
	}

	/**
	 * Given the input (channel name or vhost and\or language abbreviation), 
	 * get the setup array with all options  
	 * @return multitype:
	 */
    public function setSetupRecord()
    {
    	$this->setChannelEntity($this->input['channel']);
    	$this->setLanguageRepository();
		$this->setLanguageEntity();
		$this->setLanguageLabels();
		
		return $this->getConfigRecord();
    }
    
    public function getInput()
    {
    	return $this->input;
    }
    
    public function getEntityManager()
    {
    	return $this->em;
    }
    
    public function getChannelEntity()
    {
    	return $this->channelEntity;
    }

    	private function setChannelEntity($channelId)
    	{
    		$this->channelEntity = new Channels();
    		$this->channelEntity->setId($channelId);
    	}
    	
    	private function setLanguageRepository()
    	{
    		$this->languageRepository = new LanguagesRepository($this->em);
    		$this->languageRepository->setEntitySerializer( new EntitySerializer($this->em) );
    		$this->languageRepository->setIsOnBackend($this->input['isonbackend']);
    		$this->languageRepository->setAllAvailableLanguages($this->channelEntity);
    		$this->languageRepository->setDefaultLanguage($this->input['languageAbbreviation']);
    	}
    	
    	private function setLanguageEntity()
    	{
    		if (!$this->languageRepository->getDefaultLanguage()) {
    			return false;
    		}
    		
    		$this->languageEntity = new Languages();
    		$this->languageEntity->setId(
    					$this->languageRepository->getDefaultLanguage()->getId()
			);
    	}
    	
    	private function setLanguageLabels()
    	{
    		$languagesLabelsRepository = new LanguagesLabelsRepository($this->em);
    		$this->languageLabels = $languagesLabelsRepository->getLabels(array("language" => $this->languageEntity));
    	}
    	
    	private function getConfigRecord()
    	{
    		if (!$this->languageRepository->getDefaultLanguage()) {
    			return false;
    		}
    		
    		$configRepository = new ConfigRepository($this->em);
    		$setupRecord = $configRepository->getConfigurations(
    				array(
    					"channel" => array($this->languageRepository->getDefaultLanguage()->getChannel(), 0),
    					"isbackend" => $this->input['isbackend']
    				)
    		);
    		
    		$setupRecord['languageAllAvailable'] = $this->languageRepository->getAllAvailableLanguages();
    		$setupRecord['languageDefault'] = $this->languageRepository->getDefaultLanguage();
    		$setupRecord['languageLabels'] = $this->languageLabels;
    		
    		return array_filter($setupRecord);
    	}
}