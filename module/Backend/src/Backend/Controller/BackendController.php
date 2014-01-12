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
    	
    	// SET TEMPLATE DATA... input: previous controller result, configRecord, controller result		
		$setupManager->getTemplateDataSetter()->assignToTemplate('projectdir', 'frontend/projects/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir'));
		$setupManager->getTemplateDataSetter()->assignToTemplate('frontendtemplate', $setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate') ? $setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate') : 'default/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('basiclayout', $setupManager->getTemplateDataSetter()->getTemplateData('projectdir').'templates/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendtemplate').'layout.phtml');
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageAllAvailable', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getAllAvailableLanguages());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageDefault', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getDefaultLanguage());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageLabels', $setupManager->getSetupManagerLanguages()->getLanguageLabels());
		$setupManager->getTemplateDataSetter()->assignToTemplate('languageAbbreviation', $setupManager->getSetupManagerLanguages()->getLanguageSetup()->getLanguageAbbreviationFromDefaultLanguage());
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('basePath', $setupManager->getTemplateDataSetter()->getTemplateData('remotelinkWeb') );
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatedir', 'frontend/projects/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendprojectdir').'templates/'.$setupManager->getTemplateDataSetter()->getTemplateData('frontendTemplate'));

		$setupManager->getTemplateDataSetter()->assignToTemplate('imagedir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/images/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('cssdir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/css/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('jsdir', $setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/js/');
		
		// Record data from the controller: to revisit 		
 		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName'));
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		//$templateToRender = 'backend/templates/default/login.phtml'; // if not logged...
		
        $this->layout($templateToRender);
        $this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
        
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