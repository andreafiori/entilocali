<?php

namespace Backend\Controller;

use Zend\View\Model\ViewModel;
use ServiceLocatorFactory;
use Backend\Model\FormSetterWrapper;

/**
 * 
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 * 
 */
class BackendController extends BackendControllerAbstract
{
    public function indexAction()
    {
    	$setupManager = $this->getSetupManager();
    	$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend') );

    	$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
    	$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );

		return new ViewModel();
	}
	
	/**
	 *  TODO:
	 * 		set ACL and check if the the, 
	 * 		set view to display additional elements if you need
	 * @return \Zend\View\Model\ViewModel
	 */
	public function formdataAction()
	{	
		$setupManager = $this->getSetupManager();
		
		$formSetterWrapper = new FormSetterWrapper($setupManager);
		$formSetterWrapper->setFormSetterClassName( $this->params()->fromRoute('formsetter') );
		$formSetterWrapper->setFormSetterInstance();
		$formSetterWrapper->setFormSetterRecord( $this->params()->fromRoute('id') );
		$formSetterWrapper->setFormSetterTitle();
		$formSetterWrapper->setFormSetterDescription();
		$formSetterWrapper->setZendFormClassName();
		$formSetterWrapper->setZendFormInstance();

		$formSetterWrapper->initializeForm();
		$formSetterWrapper->setFormAction($setupManager->getTemplateDataSetter()->getTemplateData('remotelinkWeb').'backend/formpost/');
		$formSetterWrapper->setFormRecord();
		
   		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'formdata/form.phtml');

		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
   		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
   		$this->layout()->setVariable("form", $formSetterWrapper->getZendFormInstance());
   		$this->layout()->setVariable("formTitle", $formSetterWrapper->getFormSetterInstance()->getTitle());
		$this->layout()->setVariable("formDescription", $formSetterWrapper->getFormSetterInstance()->getDescription());

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
	 * TODO: use the UsersGetter class
	 * Check login, Set user session from db data
	 * set ACL role and compare with db user role
	 * set captcha on login form after 3 fails...
	
	 public function loginAction()
	 {
		 $session = new SessionContainer('base');
		 $session->offsetSet('tryvar', 'prova');
		
		 $request = $this->getRequest();
		 if ( $request->isPost() ) {
		 $userPost = (array) $request->getPost();

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
	 */
	
	/**
	 * TODO: design the recover password form
	 * @return \Zend\View\Model\ViewModel
	
	 public function recoverpasswordAction()
	 {
	 $setupManager = $this->getSetupManager();
	 $setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'dashboard/'.$setupManager->getTemplateDataSetter()->getTemplateData('dashboard_backend') );
	
	 $this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
	 $this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
	
	 return new ViewModel();
	 }
	 */
}