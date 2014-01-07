<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Languages\Model\LanguagesLabelsRepository;
use Config\Model\ConfigRepository;
use Setup\SetupManagerWrapper;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManagerWrapper = new SetupManagerWrapper( new SetupManager(
    		array(
    			'channel'	=> 1,
    			'isbackend' => 0,
    			'controller' => $this->params()->fromRoute('controller'),
    			'action'	 => $this->params()->fromRoute('action'),
    			'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    		)
    	) );
    	$setupManager = $setupManagerWrapper->initSetup();
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		$templateToRender = 'backend/templates/default/login.phtml'; // if not logged...
        
		$templateData['languageAllAvailable'] = $setupManager->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] = $setupManager->getDefaultLanguage();
		$templateData['languageLabels'] = $setupManager->getLanguageLabels();
		
        $this->layout($templateToRender);
        $this->layout()->setVariable("templateData", $templateData );
        
	}
}