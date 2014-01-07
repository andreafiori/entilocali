<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Languages\Model\LanguagesLabelsRepository;
use Config\Model\ConfigRepository;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = new SetupManager(
    		array(
    			'channel'	=> 1,
    			'isbackend' => 0,
    			'controller' => $this->params()->fromRoute('controller'),
    			'action'	 => $this->params()->fromRoute('action'),
    			'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    		)
    	);
    	$setupManager->setChannelId();
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
    	$setupManager->setLanguagesSetup();
    	$setupManager->setDefaultLanguage();
    	$setupManager->setLanguageIdFromDefaultLanguage();
    	$setupManager->setLanguageAbbreviationFromDefaultLanguage();
    	$setupManager->setLanguagesLabelsRepository( new LanguagesLabelsRepository($setupManager->getEntityManager()) );
    	$setupManager->setLanguagesLabels();
    	$setupManager->setConfigRepository( new ConfigRepository($setupManager->getEntityManager()) );
    	$setupManager->setConfigurations();
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		// $templateToRender = 'backend/templates/default/login.phtml'; // if not logged...
        
        $this->layout($templateToRender);
        $this->layout()->setVariable("templateData", $setupManager->getConfigRepository()->getConfigRecord() );
        
        $viewModel = new ViewModel();
        return $viewModel;
	}
}