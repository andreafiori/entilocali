<?php

namespace Setup\Model;

use Zend\Mvc\Controller\AbstractActionController,
	Language\Model\LanguagesRepository,
	Config\Model\ConfigRepository,
	Language\Model\LanguagesLabelsRepository,
	Setup\Model\EntitySerializer,
	Application\Entity\Channels, 
	Application\Entity\Languages;

/**
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager {

	private $input = array();
	private $setupRecord = array();
	private $em, $controller;
	
	private $channelEntity, $languageEntity;
	private $languageRepository;
	private $languageLabels;
	
	public function __construct(AbstractActionController $controller)
	{
		$this->controller = $controller;
		$this->em = $this->controller->getServiceLocator()->get('entityManagerService');
	}

	/**
	 * Set input parameters (Frontend or Backend)
	 * @param array $input
	 * @return array
	 */
	public function setInput($input)
	{
		$this->input = $input;
		$this->input['controller'] = $this->controller->params()->fromRoute('controller');
		$this->input['action'] = $this->controller->params()->fromRoute('action');
		$this->input['languageAbbreviation'] = strtolower( $this->controller->params()->fromRoute('lang') );
		return $input;
	}
	
	/**
	 * Given the input (channel name or vhost and\or language abbreviation), 
	 * get the setup array with all options  
	 * @return multitype:
	 */
    public function setSetupRecord()
    {
    	$this->setChannelEntity();
    	$this->setLanguageRepository();
		$this->setLanguageEntity();
		$this->setLanguageLabels();
		return $this->getConfigRecord();
    }
    
    /**
     * @return AbstractActionController
     */
    public function getController()
    {
    	return $this->controller;
    }
    
    public function getInput()
    {
    	return $this->input;
    }

    	private function setChannelEntity()
    	{
    		$this->channelEntity = new Channels();
    		$this->channelEntity->setId($this->input['channel']);
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