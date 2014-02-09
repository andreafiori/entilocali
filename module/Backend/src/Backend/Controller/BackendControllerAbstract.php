<?php

namespace Backend\Controller;

use Zend\Session\Container as SessionContainer;
use Setup\SetupManager;
use Backend\Controller\Plugin\BackendSetupInitializerPlugin;
use Zend\View\Helper\ViewModel;
use Application\Controller\CommonControllerAbstract;

/**
 * 
 * @author Andrea Fiori
 * @since  28 January 2014
 */
abstract class BackendControllerAbstract extends CommonControllerAbstract
{
	/**
	 * @return SetupManager
	 */
	protected function generateSetupManagerFromInitializerPlugin()
	{
		$bsip = new BackendSetupInitializerPlugin();
		$bsip->setRoute( $this->params()->fromRoute() );

		return $bsip->initializeSetupManager();
	}

	/**
	 * TODO:
	 * 		inject a different session name for each project
	 * 		login check must be common with frontend!
	 * @param SetupManager $setupManager
	 * @return boolean
	 */
	protected function checkLoginSession(SetupManager $setupManager)
	{
		$session = new SessionContainer('zf2ApiCms');
		if ( $session->offsetGet('userSession') ) {
			return true;
		}
		
		return false;
	}
	
	protected function renderLoginForm(SetupManager $setupManager)
	{
		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'login.phtml');
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		
		return new ViewModel();
	}
}