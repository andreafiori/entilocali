<?php

namespace Setup;

use Setup\SetupManager;
use Languages\Model\LanguagesSetup;
use Languages\Model\LanguagesLabelsRepository;
use Config\Model\ConfigRepository;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * Wrapper around the setup manager operations
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class SetupManagerWrapper {
	
	private $setupManager;
	private $entityManager;
	
	private $templateDataSetter;
	
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
		
		$this->entityManager = ServiceLocatorFactory::getInstance()->get('\Doctrine\ORM\EntityManager');
	}

	/**
	 * Set all main settings for the setup manager 
	 * @return SetupManager
	 */
	public function initSetup()
	{
		$this->setupManager->setChannelId();
		$this->setupManager->setEntityManager( $this->getEntityManager() );
		
		$this->setupManager->setLanguagesSetup( new LanguagesSetup($this->getEntityManager()) );
		$this->setupManager->setDefaultLanguage();
		$this->setupManager->setLanguageIdFromDefaultLanguage();
		$this->setupManager->setLanguageAbbreviationFromDefaultLanguage();
		$this->setupManager->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->getEntityManager()) );
		$this->setupManager->setLanguagesLabels();
		
		$this->setupManager->setConfigRepository( new ConfigRepository($this->getEntityManager()) );
		$this->setupManager->setConfigurations();
		$this->setupManager->getConfigRepository()->initConfigRecord();
		
		$this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( $this->setupManager->getConfigRepository()->getConfigRecord() );
		
		return $this->setupManager;
	}
	
	/**
	 * 
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
		
		/**
		 * 
		 * @return \Doctrine\ORM\EntityManager
		 */
		private function getEntityManager()
		{
			return $this->entityManager;
		}
}