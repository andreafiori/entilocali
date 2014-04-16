<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Setup\LanguagesSetup;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Application\Setup\LanguagesLabelsSetup;
use Application\Setup\ConfigSetup;

/**
 * Setup API Controller
 * 
 * @author Andrea Fiori
 * @since  07 April 2014
 */
class SetupApiController extends AbstractActionController
{
    private $serviceManager;
    private $entityManager;
    private $appConfigs;
    private $queryBuilder;

    /**
     * Complete setup returns languages and config
     */
    public function indexAction()
    {
        /* Main classes and services */
        $this->serviceManager = $this->getServiceLocator()->get('servicemanager');
        $this->entityManager = ServiceLocatorFactory::getInstance()->get('\Doctrine\ORM\EntityManager');
        $this->queryBuilder  = $this->entityManager->createQueryBuilder();

        /* Set custom configurations */
        $this->appConfigs = $this->serviceManager->get('config');
        if ( isset($this->appConfigs['app_configs']) ) {
                $this->appConfigs = $this->appConfigs['app_configs'];
        }

        $channel = 1; // Channel Detection

        /* If multi-language, now use model to get language options */
        if ( !empty($this->appConfigs['isMultilanguage']) ) {
            $languageSetup = new LanguagesSetup($this->queryBuilder);
            $languagesLabelsSetup = new LanguagesLabelsSetup($this->queryBuilder);

            $languageId = $languageSetup->setLanguageId();

            $languageRecord = array(
                                "availableLanguages" => $languageSetup->setAllAvailableLanguages($channel),
                                "defaultLanguage"	 => $languageSetup->setDefaultLanguage( $this->params()->fromQuery('languageAbbreviation') ),
                                "languageId" 		 => $languageId,
                                "languagesLabels"	 => $languagesLabelsSetup->setLanguagesLabels($languageId),
            );
        } else {
            $languageRecord = array( "languageId" => 1 );
        }

        /* Append Configurations */
        $configSetup = new ConfigSetup($this->queryBuilder);
        $configurations = $configSetup->setConfigurations($channel, $languageId);

	$isBackend = false;
	if (!$isBackend) {
            $configurations['template_project'] 	= 'frontend/projects/'.$configurations['projectdir_frontend'];
            $configurations['template_name']		= $configurations['template_frontend'] ? $configurations['template_frontend'] : 'default/';
            $configurations['template_path']	 	= $configurations['template_project'].'templates/'.$configurations['template_name'];
            $configurations['preloader_class']		= $configurations['preloader_frontend'];
	} else {
            $configurations['template_project']		= 'backend/';
            $configurations['template_name']		= $configurations['template_backend'] ? $configurations['template_backend'] : 'default/';
            $configurations['template_path']		= $configurations['template_project'].'templates/'.$configurations['template_name'];
            $configurations['preloader_class']		= $configurations['preloader_backend'];

            $configurations['loginActionBackend']		= $configurations['template_project'].'login/';
            $configurations['logoutPathBackend']            = $configurations['template_project'].'logout/';
            $configurations['loggedSectionPathBackend'] 	= $configurations['template_project'].'main/';
            $configurations['loggedSectionPathBackendWithLanguage'] = $configurations['basePath'].$configurations['loggedSectionPathBackend'].$this->getSetupManager()->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage();

            $configurations['sidebar'] = $configurations['template_path'].'sidebar/'.$configurations['sidebar_backend'];
	}

	// Set languages vars
	if ( isset($config['app_configs']['isMultilanguage']) ) {
            $configurations['languages'] = $availableLanguages;
            $configurations['languageDefault'] = $defaultLanguage;
            $configurations['languageAbbreviation'] = ''; // from route...
            $configurations['languageId'] = $languageId;
            $configurations['languageLabels'] = $languagesLabels;
	}

	// Basic layout
	$configurations['basiclayout'] = $configurations['template_path'].'layout.phtml';

	// Assets
	$configurations['imagedir'] = $configurations['template_project'].'templates/'.$configurations['template_name'].'assets/images/';
	$configurations['cssdir']   = $configurations['template_project'].'templates/'.$configurations['template_name'].'assets/css/';
	$configurations['jsdir']    = $configurations['template_project'].'templates/'.$configurations['template_name'].'assets/js/';

        return new JsonModel(
                array(
                    'status'=> 200,
                    'data' => array_merge( $languageRecord, array("config" => $configurations ) )
                )
        );
    }
}