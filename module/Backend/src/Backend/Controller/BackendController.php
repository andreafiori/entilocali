<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Setup\SetupManagerWrapper;
use Zend\View\Model\ViewModel;

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
    	
		$templateData['languageAllAvailable'] = $setupManager->getLanguageSetup()->getAllAvailableLanguages();
		$templateData['languageDefault'] = $setupManager->getDefaultLanguage();
		$templateData['languageLabels'] = $setupManager->getLanguageLabels();
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		$templateToRender = 'backend/templates/default/login.phtml'; // if not logged...
		
        $this->layout($templateToRender);
        $this->layout()->setVariable("templateData", $templateData );
        
        return new ViewModel();
	}
	
	public function formdataAction()
	{
		return new ViewModel();
	}
	
	public function gridAction()
	{
		return new ViewModel();
	}
}