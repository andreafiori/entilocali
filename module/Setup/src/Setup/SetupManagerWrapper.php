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
		
		$this->getSetupManager()->setEntityManager( $this->getEntityManager() );
	}

	public function detectChannel()
	{
		$this->getSetupManager()->setChannelId();
	}

	public function setupLanguages()
	{
		$this->getSetupManager()->getSetupManagerLanguages()->setLanguagesSetup( new LanguagesSetup($this->getSetupManager()) );
		$this->getSetupManager()->getSetupManagerLanguages()->setAllAvailableLanguages( $this->getSetupManager()->getInput('channel') );
		$this->getSetupManager()->getSetupManagerLanguages()->setDefaultLanguage( $this->getSetupManager()->getInput('languageAbbreviation') );
		$this->getSetupManager()->getSetupManagerLanguages()->setLanguageIdFromDefaultLanguage();
		$this->getSetupManager()->getSetupManagerLanguages()->setLanguageAbbreviationFromDefaultLanguage();
	}
	
	public function setupLanguagesLabels()
	{
		$languagesLabelsQueryBuilder = new LanguagesLabelsQueryBuilder();
		$languagesLabelsQueryBuilder->setSetupManager( $this->getSetupManager() );
		$languagesLabelsQueryBuilder->setLanguage( $this->getSetupManager()->getSetupManagerLanguages()->getLanguageId() );
		$languagesLabelsQueryBuilder->setBasicBindParameters();
		
		$this->getSetupManager()->getSetupManagerLanguagesLabels()->setLanguagesLabels( $languagesLabelsQueryBuilder->getSelectResult() );
	}
	
	public function setupConfigurations()
	{
		$configQueryBuilder = new ConfigQueryBuilder();
		$configQueryBuilder->setSetupManager($this->setupManager);
		$configQueryBuilder->setBasicBindParameters();
		
		$this->getSetupManager()->getSetupManagerConfigurations()->setConfigQueryBuilder($configQueryBuilder);
		$this->getSetupManager()->getSetupManagerConfigurations()->setConfigurations();
	}
	
	/**
	 * Assign to preloadrecord the default class record\result
	 */
	public function setupPreloadRecord()
	{
		$this->getSetupManager()->getSetupManagerPreload()->setClassName( $this->getSetupManager()->getTemplateDataSetter()->getTemplateData('preloader_class') );
		$this->getSetupManager()->getSetupManagerPreload()->setInstance($this->setupManager);
		$this->getSetupManager()->getTemplateDataSetter()->assignToTemplate('preloadrecord', $this->getSetupManager()->getSetupManagerPreload()->setRecord() );
		$this->getSetupManager()->setInput( $this->setupManagerInput );
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
		
	/**
	 * TODO: export this method and move on  
	 * @throws NullException
	 */
	public function setupTemplateRecords()
	{	
		$configRecord 	= $this->getSetupManager()->getSetupManagerConfigurations()->getConfigurations();
		$isBackend 		= $this->getSetupManager()->getInput('isbackend');
		
		if (!$configRecord) {
			throw new NullException('No configurations on setup manager wrapper');
		}

		$templateData = $configRecord;
		
		$templateData['basePath'] = $configRecord['remotelinkWeb'];
		if (!$isBackend) {
			$templateData['template_project'] 	= 'frontend/projects/'.$configRecord['projectdir_frontend'];
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
			$templateData['loggedSectionPathBackendWithLanguage'] = $templateData['basePath'].$templateData['loggedSectionPathBackend'].$this->getSetupManager()->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();

			$templateData['sidebar'] = $templateData['template_path'].'sidebar/'.$configRecord['sidebar_backend'];
		}
		
		/* Set language\s vars */
		$templateData['languageAllAvailable'] = $this->getSetupManager()->getSetupManagerLanguages()->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] 	  = $this->getSetupManager()->getSetupManagerLanguages()->getLanguageSetup()->getDefaultLanguage();
		$templateData['languageLabels'] 	  = $this->getSetupManager()->getSetupManagerLanguagesLabels()->getLanguageLabels();
		$templateData['languageAbbreviation'] = $this->getSetupManager()->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();
		$templateData['languageId'] 		  = $this->getSetupManager()->getSetupManagerLanguages()->getLanguageId();

		/* Basic layout if not set... */
		$templateData['basiclayout'] = $templateData['template_path'].'layout.phtml';

		/* Assets */
		$templateData['imagedir'] = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/images/';
		$templateData['cssdir']   = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/css/';
		$templateData['jsdir']    = $templateData['template_project'].'templates/'.$templateData['template_name'].'assets/js/';

		$this->getSetupManager()->setTemplateDataSetter( new TemplateDataSetter($this->setupManager) );

		/* Assign final template var */
		$this->getSetupManager()->getTemplateDataSetter()->mergeTemplateDataWithArray( array_filter($templateData) );
	}

}