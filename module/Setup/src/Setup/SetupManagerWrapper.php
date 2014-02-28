<?php

namespace Setup;

use Setup\SetupManager;
use Languages\Model\LanguagesSetup;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Languages\Model\LanguagesLabelsQueryBuilder;
use Config\Model\ConfigQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class SetupManagerWrapper
{
	private $setupManager;
	
	private $setupManagerInput;

	private $entityManager;

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager 	 = $setupManager;

		$this->setupManagerInput = $setupManager->getInput();
	}

	public function setupEntityManager($em = null)
	{
		if ($em) {
			$this->entityManager = $em;
		} else {
			$this->entityManager = ServiceLocatorFactory::getInstance()->get('\Doctrine\ORM\EntityManager');
		}
		
		$this->setupManager->setEntityManager( $this->getEntityManager() );
	}

	public function detectChannel()
	{
		$this->setupManager->setChannelId();
	}

	public function setupLanguages()
	{
		$this->setupManager->getSetupManagerLanguages()->setLanguagesSetup( new LanguagesSetup($this->getSetupManager()) );
		$this->setupManager->getSetupManagerLanguages()->setAllAvailableLanguages($this->getSetupManager()->getInput('channel'));
		$this->setupManager->getSetupManagerLanguages()->setDefaultLanguage( $this->getSetupManager()->getInput('languageAbbreviation') );
		$this->setupManager->getSetupManagerLanguages()->setLanguageIdFromDefaultLanguage();
		$this->setupManager->getSetupManagerLanguages()->setLanguageAbbreviationFromDefaultLanguage();
	}
	
	public function setupLanguagesLabels()
	{
		$languagesLabelsQueryBuilder = new LanguagesLabelsQueryBuilder();
		$languagesLabelsQueryBuilder->setSetupManager($this->getSetupManager());

		$this->setupManager->getSetupManagerLanguagesLabels()->setLanguagesLabels($languagesLabelsQueryBuilder);
	}
	
	public function setupConfigurations()
	{
		$configQueryBuilder = new ConfigQueryBuilder();
		$configQueryBuilder->setSetupManager($this->setupManager);
		$configQueryBuilder->setBasicBindParameters();
		
		$this->setupManager->getSetupManagerConfigurations()->setConfigQueryBuilder($configQueryBuilder);
		$this->setupManager->getSetupManagerConfigurations()->setConfigurations();
	}
	
	/**
	 * Assign to preloadrecord the default class record\result
	 */
	public function setupPreloadRecord()
	{
		$this->setupManager->getSetupManagerPreload()->setClassName( $this->setupManager->getTemplateDataSetter()->getTemplateData('preloader_class') );
		$this->setupManager->getSetupManagerPreload()->setInstance($this->setupManager);
		$this->setupManager->getTemplateDataSetter()->assignToTemplate('preloadrecord', $this->setupManager->getSetupManagerPreload()->setRecord() );
		$this->setupManager->setInput( $this->setupManagerInput );
	}
	
	/**
	 * TODO: export this method and move on  
	 * @throws NullException
	 */
	public function setupTemplateRecords()
	{	
		$configRecord 	= $this->setupManager->getSetupManagerConfigurations()->getConfigurations();
		$isBackend 		= $this->setupManager->getInput('isbackend');
		
		if (!$configRecord) {
			throw new NullException('No configurations on setup manager wrapper');
		}
		
		$templateData = array();
		$templateData = array_merge($templateData, $configRecord);
		
		$templateData['basePath'] = $configRecord['remotelinkWeb'];
		if (!$isBackend) {
			$templateData['template_project'] 	= 'frontend/projects/'.$configRecord['project_frontend'];
			$templateData['template_name']		= $configRecord['template_frontend'] ? $configRecord['template_frontend'] : 'default/';
			$templateData['template_path']	 	= $templateData['template_project'].'templates/'.$templateData['template_name'];
			$templateData['preloader_class']	= $templateData['preloader_frontend'];
		} else {
			$templateData['template_project']	= 'backend/';
			$templateData['template_name']		= $configRecord['template_backend'] ? $configRecord['template_backend'] : 'default/';
			$templateData['template_path']		= $templateData['template_project'].'templates/'.$templateData['template_name'];
			$templateData['preloader_class']	= $templateData['preloader_backend'];
			
			$templateData['loginActionBackend']		  = $templateData['template_project'].'login/';
			$templateData['logoutPathBackend']		  = $templateData['template_project'].'logout/';
			$templateData['loggedSectionPathBackend'] = $templateData['template_project'].'main/';
			$templateData['loggedSectionPathBackendWithLanguage'] = $templateData['basePath'].$templateData['loggedSectionPathBackend'].$this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();

			$templateData['sidebar'] = $templateData['template_path'].'sidebar/'.$configRecord['sidebar_backend'];
		}
		
		/* Set language\s vars */
		$templateData['languageAllAvailable'] = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] 	  = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getDefaultLanguage();
		$templateData['languageLabels'] 	  = $this->setupManager->getSetupManagerLanguagesLabels()->getLanguageLabels();
		$templateData['languageAbbreviation'] = $this->setupManager->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();
		$templateData['languageId'] 		  = $this->setupManager->getSetupManagerLanguages()->getLanguageId();

		/* Basic layout if not set... */
		$templateData['basiclayout'] = $templateData['template_path'].'layout.phtml';
	
		/* Assets */
		$templateData['imagedir'] = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/images/';
		$templateData['cssdir']   = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/css/';
		$templateData['jsdir']    = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/js/';

		$this->setupManager->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );
	
		/* Assign final template var */
		$this->setupManager->getTemplateDataSetter()->mergeTemplateDataWithArray( array_filter($templateData) );
	}

	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}

		/**
		 * @return \Doctrine\ORM\EntityManager
		 */
		private function getEntityManager()
		{
			if (!$this->entityManager) {
				$this->setupEntityManager();
			}
			
			return $this->entityManager;
		}
}