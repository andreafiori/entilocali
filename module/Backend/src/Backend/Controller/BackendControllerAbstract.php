<?php

namespace Backend\Controller;

use Zend\Session\Container as SessionContainer;
use Setup\SetupManager;
use Zend\View\Helper\ViewModel;
use Application\Controller\CommonControllerAbstract;

/**
 * @author Andrea Fiori
 * @since  28 January 2014
 */
abstract class BackendControllerAbstract extends CommonControllerAbstract
{
	/**
	 * @return boolean
	 */
	protected function checkLoginSession()
	{
		$session = new SessionContainer('zf2ApiCms');
		if ( $session->offsetGet('userSession') ) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * @param SetupManager $setupManager
	 * @return \Zend\View\Helper\ViewModel
	 */
	protected function renderLoginForm(SetupManager $setupManager)
	{
		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'login.phtml');
		
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		
		return new ViewModel();
	}
}