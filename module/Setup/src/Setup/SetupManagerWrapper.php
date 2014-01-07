<?php

namespace Setup;

use Setup\SetupManager;
use Languages\Model\LanguagesSetup;
use Languages\Model\LanguagesLabelsRepository;
use Config\Model\ConfigRepository;
use ServiceLocatorFactory\ServiceLocatorFactory;

class SetupManagerWrapper {
	
	private $setupManager;
	private $entityManager;
	
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
		$this->setupManager->setEntityManager( $this->entityManager );
		$this->setupManager->setLanguagesSetup( new LanguagesSetup($this->entityManager) );
		$this->setupManager->setDefaultLanguage();
		$this->setupManager->setLanguageIdFromDefaultLanguage();
		$this->setupManager->setLanguageAbbreviationFromDefaultLanguage();
		$this->setupManager->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->entityManager) );
		$this->setupManager->setLanguagesLabels();
		$this->setupManager->setConfigRepository( new ConfigRepository($this->entityManager) );
		$this->setupManager->setConfigurations();
		$this->setupManager->getConfigRepository()->initConfigRecord();
		
		return $this->setupManager;
	}
}