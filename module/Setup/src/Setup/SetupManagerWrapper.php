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
		
		$this->entityManager = ServiceLocatorFactory::getInstance()->get('\Doctrine\ORM\EntityManager');
		$this->setupManager->setEntityManager( $this->getEntityManager() );
	}

	/**
	 * Set all main settings for the setup manager 
	 * @return SetupManager
	 */
	public function initSetup()
	{
		/* Channel detection */
		$this->setupManager->setChannelId();
		
		/* Language\s */
		$this->setupManager->getSetupManagerLanguages()->setLanguagesSetup( new LanguagesSetup($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguages()->setAllAvailableLanguages($this->setupManager->getInput('channel'));
		$this->setupManager->getSetupManagerLanguages()->setDefaultLanguage( $this->setupManager->getInput('languageAbbreviation') );
		$this->setupManager->getSetupManagerLanguages()->setLanguageIdFromDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguageAbbreviationFromDefaultLanguage();
		
		/* Language Labels */
		$this->setupManager->getSetupManagerLanguagesLabels()->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerLanguagesLabels()->setLanguagesLabels( $this->setupManager->getSetupManagerLanguages()->getDefaultLanguage('id') );

		/* Configurations */
		$this->setupManager->getSetupManagerConfigurations()->setConfigRepository( new ConfigRepository($this->getEntityManager()) );
		$this->setupManager->getSetupManagerConfigurations()->setConfigurations();
		$this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->initConfigRecord();
				
		/* TEMPLATE DATA SETTINGS */
			// Template Data Setter initialization: $this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
		$configRecord 	= $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord(); // WRONG PROCEDURE!!!
		$isBackend 		= $this->setupManager->getInput('backend');
		
		$templateData = array();
		$templateData = array_merge($templateData, $configRecord);
		
		if (!$isBackend) {
			$templateData['project'] = 'frontend/projects/'.$configRecord['project_frontend'];
			$templateData['template'] = $configRecord['template_frontend'] ? $configRecord['template_frontend'] : 'default/';			
		} else {
			$templateData['project'] = 'backend/projects/'.$configRecord['project_backend'];
			$templateData['template'] = $configRecord['project_backend'] ? $configRecord['backendprojectdir'] : 'default/';
		}
		// if set from controller, this can be different...
		$templateData['basiclayout'] = $templateData['project'].'templates/'.$templateData['template'].'layout.phtml';		
		
		$templateData['languageAllAvailable'] = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getDefaultLanguage();
		$templateData['languageLabels'] = $this->setupManager->getSetupManagerLanguagesLabels()->getLanguageLabels();
		$templateData['languageAbbreviation'] = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();
		$templateData['languageId'] = $this->setupManager->getSetupManagerLanguages()->getLanguageId();
		
		$templateData['imagedir'] = $templateData['project'].'templates/'.$templateData['template'].'assets/images/';
		$templateData['cssdir']   = $templateData['project'].'templates/'.$templateData['template'].'assets/css/';
		$templateData['jsdir']    = $templateData['project'].'templates/'.$templateData['template'].'assets/js/';
		
		$this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('basePath', $this->setupManager->getTemplateDataSetter()->getTemplateData('remotelinkWeb') );
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('template', 'frontend/projects/'.$this->setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir').'templates/'.$this->setupManager->getTemplateDataSetter()->getTemplateData('frontendTemplate'));
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( array_filter($templateData) );
		
		return $this->setupManager;
	}

	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}

		/**
		 * TODO: to remove
		 * @return \Doctrine\ORM\EntityManager
		 */
		private function getEntityManager()
		{
			return $this->entityManager;
		}
}