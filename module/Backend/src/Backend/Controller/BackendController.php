<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Setup\SetupManager;
use ServiceLocatorFactory;
use Zend\View\Model\ViewModel;
use Users\Model\UsersQueryBuilder;
use Zend\Session\Container as SessionContainer;
use Application\Controller\Plugin\SetupManagerPlugin;
use Backend\Model\FormSetter;
use Backend\Model\FormSetterWrapper;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = $this->getSetupManager();

    	$session = new SessionContainer('zf2ApiCms');
    	if ( !$session->offsetGet('userSession') ) {
    		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'login.phtml');
	    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );   	
	    	
	    	return new ViewModel();
    	}

    	$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend') );

    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );

		return new ViewModel();
	}

	/**
	 * 
	 * @return \Zend\View\Model\ViewModel
	 */
	public function recoverpasswordAction()
	{
		return new ViewModel();
	}
	
	/**
	 * TODO: get the postForm name from $_REQUEST and the ID number. If not present, get an empty form
	 * @return \Zend\View\Model\ViewModel
	 */
	public function formdataAction()
	{
		$setupManager = $this->getSetupManager();
		
		$formSetterFromRoute = $this->params()->fromRoute('formsetter');
		$formSetterWrapper = new FormSetterWrapper($setupManager);
		$formSetterWrapper->isValidFormSetter($formSetterFromRoute);
		
		var_dump( $formSetterWrapper->getFormSetter() );
		/*
		$formSetter = new FormSetterInitializer($setupManager);
		$formSetter->setRecord( $this->params()->fromRoute('id') );
		$formSetter->setForm( new $formObject( $setupManager ) );
		$formSetter->setFormTitle( new $formObject( $setupManager ) );
		$formSetter->setFormDescription( new $formObject( $setupManager ) );

		$formSetter->getAdditionalView(); // view to display additional elements
		*/
		
		$request = $this->getRequest();
    	if ( $request->isPost() ) {
    		$form->setInputFilter( $form->getInputFilter() );
    		$form->setData($request->getPost());
   			$form->isValid();
   		}
   		
   		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'formdata/form.phtml');
   		
   		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
   		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
   		$this->layout()->setVariable("form", $form);
   		
		return new ViewModel();
	}

	/**
	 * catch the post and show result
	 */
	public function formpostAction()
	{
		$setupManager = $this->getSetupManager();

		$request = $this->getRequest();
	    if ( $request->isPost() ) {
	    	
	    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'message.phtml');
			$this->layout()->setVariable("messageTitle", "In costruzione");
			$this->layout()->setVariable("messageText", "Form app in costruzione");
			
			return new ViewModel();
	    }

	    return new ViewModel();
	}

	/**
	 * Check login, Set user session from db data
	 * set ACL role and compare with db user role
	 * set captcha on login form after 3 fails...
	 */
	public function loginAction()
	{
		$session = new SessionContainer('base');
		$session->offsetSet('tryvar', 'prova');
	
		$request = $this->getRequest();
		if ( $request->isPost() ) {
			$userPost = (array) $request->getPost();
				
			/* TODO: use the UsersGetter class */
			$users = new UsersQueryBuilder();
			$users->setSetupManager( $this->getSetupManager() );
			$users->setPassword($userPost['password']);
			$users->setEmail($userPost['username']);
			$userRecord = $users->getSelectResult();
	
			if ( is_array($users->getSelectResult()) ) {
				$userRecord = $userRecord[0];
	
				$session = new SessionContainer('zf2ApiCms');
				$session->offsetSet('userSession', $userRecord);
				$session->offsetSet('createDate', date("Y-m-d H:i:s"));
			}
				
		}
	
		return $this->redirect()->toRoute("homepage");
	}
	
	public function logoutAction()
	{
		$session = new SessionContainer('zf2ApiCms');
		$session->getManager()->getStorage()->clear('zf2ApiCms');
		$session->getManager()->destroy();
	
		return $this->redirect()->toRoute("homepage", array("action" => "index") );
	}
	
		/**
		 * 
		 * @return SetupManager
		 */
		private function getSetupManager()
		{
			$setupManagerPlugin = new SetupManagerPlugin();

	    	$setupManager = $setupManagerPlugin->initialize(
	    			array(
						'channel'				=> 1,
						'isbackend' 			=> 1,
						'controller'			=> $this->params()->fromRoute('controller'),
						'action'				=> $this->params()->fromRoute('action'),
						'languageAbbreviation' 	=> strtolower( $this->params()->fromRoute('lang') )
					)
	    	);
	    	
			return $setupManager;
		}

}