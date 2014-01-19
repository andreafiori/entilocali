<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Setup\SetupManagerWrapper;
use Zend\View\Model\ViewModel;

/**
 * TODO:
 * 		check login
 * 		validate form 
 * 		session login
 * 		set user session from db data
 * 		set ACL role and compare with db user role
 *  	set captcha on login form after 3 fails...
 *  	
 *  	backup database
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
	private $setupManager;

    public function indexAction()
    {
    	$setupManager = $this->getSetupManager();
    	
    	/*
    	var_dump( $this->params()->fromQuery() );
    	var_dump( $this->params()->fromRoute('ctrl') );   
    	*/
    	
    	$this->layout('backend/templates/default/backend.phtml');
    	
    	/* Template to include */   	
    	switch($this->params()->fromRoute('ctrl')):
    	
	    	default:
	    		$templatePartial = 'backend/templates/default/dashboard.phtml';
	    	break;
	    	
	    	case("formdata"):
	    		$templatePartial = 'backend/templates/default/formdata/form.phtml';
	    	break;
	    	
	    	case("grid"):
	    		$templatePartial = 'backend/templates/default/grid/grid.phtml';
	    	break;
	    	
    	endswitch;
    	
    	$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $templatePartial);
    	
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
    	
		return new ViewModel();
	}
		
	public function formdataAction()
	{
		$setupManager = $this->getSetupManager();  
    	
    	$templateToRender = 'backend/templates/default/backend.phtml';
    	//$templateToRender = 'backend/templates/default/login.phtml';
    	
    	$this->layout($templateToRender);
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		
		return new ViewModel();
	}
	
	public function gridAction()
	{
		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent('Grid with datatables are under construction');
		return $response;
	}
	
	public function loginAction()
	{
		$request = $this->getRequest();
		if ( $request->isPost() ) {
			// $userPost = (array) $request->getPost();
			return $this->redirect()->toRoute("backend", array("action" => "index") );
		} else {
			return $this->redirect()->toRoute("backend", array("action" => "index") );
		}
		
		$response = $this->getResponse();
		$response->setStatusCode(200);
		return $response;
	}
	
	public function forgotpasswordAction()
	{
		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent('Forgot password form is under construction');
		return $response;
	}
	
	public function logoutAction()
	{
		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent('Logout is under construction');
		return $response;
	}
	
	public function backupAction()
	{
		
	}
	
		/**
		 * 
		 * @return SetupManager
		 */
		private function getSetupManager()
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
		
			/* Preload */
			$setupManager->getSetupManagerPreload()->setClassName( $setupManager->getTemplateDataSetter()->getTemplateData('preloader_frontend') );
			$setupManager->getSetupManagerPreload()->setInstance($setupManager);
			$setupManager->getTemplateDataSetter()->assignToTemplate('preloadrecord', $setupManager->getSetupManagerPreload()->setRecord() );
				
			/* TEMPLATE DATA */
			// $setupManager->getTemplateDataSetter()->assignToTemplate('controllerResult', $postsDetail);
			$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName') );
		
			/* SEO Tags */
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', 		$setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', 	$setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
		
			return $setupManager;
		}
}