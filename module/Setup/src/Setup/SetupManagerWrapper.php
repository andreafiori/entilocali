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
		
		$this->setupManager->getSetupManagerLanguages()->setLanguagesSetup( new LanguagesSetup($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguages()->setDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguageIdFromDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguageAbbreviationFromDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguages()->setLanguagesLabels();

		$this->setupManager->getSetupManagerConfigurations()->setConfigRepository( new ConfigRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerConfigurations()->setConfigurations();
		$this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->initConfigRecord();
		
		$this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord() );
		
		$this->setupManager->getSetupManagerAlwaysToLoad()->setClassName($this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('homepagecontroller'));
		$this->setupManager->getSetupManagerAlwaysToLoad()->setRecord();
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray($this->setupManager->getSetupManagerAlwaysToLoad()->getRecord(), 'alwaystoload');
		
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