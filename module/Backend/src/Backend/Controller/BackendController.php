<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Setup\SetupManagerWrapper;
use Zend\View\Model\ViewModel;
use Posts\Form\PostsForm;
use Users\Model\UsersQueryBuilder;
use Zend\Session\Container;

/**
 * 
 * TODO:
 * 		validate login form
 *  	
 *  	backup database
 * 
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = $this->getSetupManager();
    	
    	/* // session destroy (test)
    	$session = new Container('zf2ApiCms');
    	$session->getManager()->getStorage()->clear('zf2ApiCms');
    	*/
    	
    	/* Check Login and (TODO) if the session is valid! */
    	$session = new Container('zf2ApiCms');
    	if ( !$session->offsetGet('userSession') ) {
	    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'login.phtml');
	    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );   	
	    	
	    	return new ViewModel();
    	}
    	
    	/* Main Template swtich */
    	switch($this->params()->fromRoute('ctrl')):

	    	default: case("dashboard"):
	    		$templatePartial = 'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend');
	    	break;
	    	
	    	case("formdata"):
				$templatePartial = 'formdata/form.phtml';

	    		$form =  new PostsForm($setupManager);
	    		$request = $this->getRequest();
	    		
	    		// HYDRATOR: $form->setData( array("title"=>'My default title') );
	    		if ( $request->isPost() ) {
	    			$form->setInputFilter($form->getInputFilter());
	    			$form->setData($request->getPost());

	    			$form->isValid();
	    		}
	    	break;

	    	case("grid"):
	    		$templatePartial = 'grid/grid.phtml';
	    	break;

    	endswitch;

    	$setupManager->getTemplateDataSetter()->assignToTemplate('sidebar', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'sidebar/'.$setupManager->getTemplateDataSetter()->getTemplateData('sidebar_backend'));
    	$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').$templatePartial);
    	
    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
    	$this->layout()->setVariable("form", $form);

		return new ViewModel();
	}
	
	/**
	 * check login
 	 * set user session from db data
 	 * set ACL role and compare with db user role
 	 * set captcha on login form after 3 fails...
	 */
	public function loginAction()
	{
		$request = $this->getRequest();
		if ( $request->isPost() ) {
			$userPost = (array) $request->getPost();
			
			/* TODO: use the UsersGetter class */
			$users = new UsersQueryBuilder();
			$users->setSetupManager($this->getSetupManager());
			$users->setPassword($userPost['password']);
			$users->setEmail($userPost['username']);
			$userRecord = $users->getSelectResult();

			if ( is_array($users->getSelectResult()) ) {
				$userRecord = $userRecord[0];

				$session = new Container('zf2ApiCms');
				$session->offsetSet('userSession', $userRecord);
				$session->offsetSet('createDate', date("Y-m-d H:i:s"));
				
				return $this->redirect()->toRoute("homepage", array("action" => "index") );
			}

		}
		
		return $this->redirect()->toRoute("homepage", array("action" => "index") );
	}
	
	/**
	 * destroy the user session
	 */
	public function logoutAction()
	{
		$session = new Container('zf2ApiCms');
		$session->getManager()->getStorage()->clear('zf2ApiCms');
		
		return $this->redirect()->toRoute("homepage", array("action" => "index") );
	}
	
	/**
	 * TODO: if session ok, redirect to main else show recover password form...
	 * @return \Zend\View\Model\ViewModel
	 */
	public function recoverpasswordAction()
	{
		return new ViewModel();
	}
	
		/**
		 * @return SetupManager
		 */
		private function getSetupManager()
		{
			$input = array(
							'channel'				=> 1,
							'isbackend' 			=> 1,
							'controller'			=> $this->params()->fromRoute('controller'),
							'action'				=> $this->params()->fromRoute('action'),
							'languageAbbreviation' 	=> strtolower( $this->params()->fromRoute('lang') )
					); 
			$setupManagerWrapper = new SetupManagerWrapper( new SetupManager( $input ) );
			$setupManager = $setupManagerWrapper->initSetup();
			
			/* Preload */
			$setupManager->getSetupManagerPreload()->setClassName( $setupManager->getTemplateDataSetter()->getTemplateData('preloader_class') );
			$setupManager->getSetupManagerPreload()->setInstance($setupManager);
			$setupManager->getTemplateDataSetter()->assignToTemplate('preloadrecord', $setupManager->getSetupManagerPreload()->setRecord() );

			$setupManager->setInput($input);
			
			/* TEMPLATE DATA */
			$setupManager->getTemplateDataSetter()->assignToTemplate('categoryName', $setupManager->getInput('categoryName') );
		
			/* SEO Tags */
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_title', 		$setupManager->getTemplateDataSetter()->getTemplateData('sitename'));
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_description', $setupManager->getTemplateDataSetter()->getTemplateData('description'));
			$setupManager->getTemplateDataSetter()->assignToTemplate('seo_keywords', 	$setupManager->getTemplateDataSetter()->getTemplateData('keywords'));
		
			return $setupManager;
		}

}