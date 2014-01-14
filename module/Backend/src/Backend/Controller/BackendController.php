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
	private $setupManager;
	
	public function __construct()
	{
		// TODO: setup and login check timeout and if logged
	}
	
    public function indexAction()
    {
    	$setupManagerWrapper = new SetupManagerWrapper( new SetupManager(
    		array(
    			'channel'				=> 1,
    			'isbackend' 			=> 0,
    			'controller'			=> $this->params()->fromRoute('controller'),
    			'action'				=> $this->params()->fromRoute('action'),
    			'languageAbbreviation' 	=> strtolower( $this->params()->fromRoute('lang') )
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

		$setupManager->getTemplateDataSetter()->assignToTemplate('imagedir',$setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/images/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('cssdir',	$setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/css/');
		$setupManager->getTemplateDataSetter()->assignToTemplate('jsdir', 	$setupManager->getTemplateDataSetter()->getTemplateData('templatedir').'assets/js/');
		
		// Record data from the controller: to revisit 		
 		$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName'));
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		$templateToRender = 'backend/templates/default/login.phtml';
				
		$this->layout($templateToRender);
        $this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
        
		return new ViewModel();
	}
		
	public function formdataAction()
	{
		$templateToRender = 'backend/templates/default/backend.phtml';
		
		return new ViewModel();
	}
	
	public function gridAction()
	{
		return new ViewModel();
	}
	
	/**
	 * TODO: 
	 * 		validate form 
	 * 		session login
	 * 		set user session from db data
	 * 		set ACL role and compare with db user role
	 *  	
	 * @return \Zend\View\Model\ViewModel
	 */
	public function loginAction()
	{
		$request = $this->getRequest();
		if ( $request->isPost() ) {
			//$userLoginAuth = new UserLoginAuth(array $input); $record = setRecord();
			//$userPost = (array) $request->getPost();
			
			//$session = new Container('base');
			//$session->offsetSet('name', "Andrea");
			//$session->offsetGet('name');
			
			//return $this->redirect()->toRoute("backend", array("action" => "index") );
			echo "here!";
		} else {
			//echo "No auth. Redirect... After 3 fails, show captcha!";
			return $this->redirect()->toRoute("backend", array("action" => "index") );
		}
		
		$response = $this->getResponse();
		$response->setStatusCode(200);
		//$response->setContent('foo');
		return $response;
	}
	
	public function logoutAction()
	{
		
	}
}