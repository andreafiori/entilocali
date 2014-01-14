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
class SetupManagerWrapper
{
	private $setupManager;
	private $entityManager;

	private $templateDataSetter;
	
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
		
		// TODO: to remove
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
		
		$this->setupManager->getSetupManagerLanguages()->setLanguagesSetup( new LanguagesSetup($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguages()->setAllAvailableLanguages($this->setupManager->getInput('channel'));
		$this->setupManager->getSetupManagerLanguages()->setDefaultLanguage( $this->setupManager->getInput('languageAbbreviation') );
		$this->setupManager->getSetupManagerLanguages()->setLanguageIdFromDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguageAbbreviationFromDefaultLanguage();
		
		/* Language labels ... */
		$this->setupManager->getSetupManagerLanguagesLabels()->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguagesLabels()->setLanguagesLabels( $this->setupManager->getSetupManagerLanguages()->getDefaultLanguage('id') );
		
		/* Configurations */
		$this->setupManager->getSetupManagerConfigurations()->setConfigRepository( new ConfigRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerConfigurations()->setConfigurations();
		$this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->initConfigRecord();
		
		/* Template Data Setter initialization */
		$this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord() );
		
		/* Alway to load object if set */
		$this->setupManager->getSetupManagerAlwaysToLoad()->setClassName( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('homepagecontroller') );
		
		/* 
		 * TODO: cache loaded records
		$instance = $this->setupManager->getSetupManagerAlwaysToLoad()->getClassName();
		$instance = new $instance($this->setupManager);
		$instance->setRecord();
		var_dump($instance->getRecord());
		*/
		
		/* TODO: main data \ controller exchange with template layout name... */
		
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