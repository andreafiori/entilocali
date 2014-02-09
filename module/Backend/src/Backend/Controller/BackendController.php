<?php

namespace Backend\Controller;

use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Users\Model\UsersQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends BackendControllerAbstract
{
    public function indexAction()
    {
    	$setupManager = $this->generateSetupManagerFromInitializerPlugin();
    	$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend') );
    	
		if ( !$this->checkLoginSession($setupManager) ) {
			return $this->renderLoginForm($setupManager);
    	}
    	
    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		
    	return new ViewModel();
	}

	/**
	 * TODO: 
	 * 		 use the UsersGetter class
	 * 		 set ACL role and compare with db user role
	 * 		 set captcha on login form after 3 fails...
	*/
	 public function loginAction()
	 {
		$request = $this->getRequest();
		if ( $request->isPost() ) {
			$userPost = (array) $request->getPost();
			
			$users = new UsersQueryBuilder();
			$users->setSetupManager( $this->generateSetupManagerFromInitializerPlugin() );
			$users->setPassword($userPost['password']);
			$users->setEmail($userPost['username']);
			$userRecord = $users->getSelectResult();
			
			if ( is_array($users->getSelectResult()) ) {
				$userRecord = $userRecord[0];
				
				$session = new \Zend\Session\Container('zf2ApiCms');
				$session->offsetSet('userSession', $userRecord);
				$session->offsetSet('createDate', date("Y-m-d H:i:s"));
			}
		}
		
		return $this->redirect()->toRoute("backend");
	}

	public function logoutAction()
	{
		$session = new \Zend\Session\Container('zf2ApiCms');
		$session->getManager()->getStorage()->clear('zf2ApiCms');
		$session->getManager()->destroy();
		
		return $this->redirect()->toRoute("backend", array("action" => "index") );
	}

	/**
	 * @return \Zend\View\Model\ViewModel
	
	public function recoverpasswordAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend') );

		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );

		return new ViewModel();
	}
	*/
}