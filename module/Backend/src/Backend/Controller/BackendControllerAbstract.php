<?php

namespace Backend\Controller;

use Zend\Session\Container as SessionContainer;
use Setup\SetupManager;
use Backend\Controller\Plugin\BackendSetupInitializerPlugin;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * 
 * Backend controller
 * @author Andrea Fiori
 * @since  28 January 2014
 * 
 */
abstract class BackendControllerAbstract extends AbstractActionController
{
	/**
	 * @return SetupManager
	 */
	protected function getSetupManager()
	{
		$bsip = new BackendSetupInitializerPlugin();
		$bsip->setRoute( $this->params()->fromRoute() );

		return $bsip->initializeSetupManager();
	}
	
	protected function checkLoginSession(SetupManager $setupManager)
	{
		$session = new SessionContainer('zf2ApiCms');
		if ( !$session->offsetGet('userSession') ) {
			
			$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'login.phtml');
			$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		
			return false;
		}
		
		return true;
	}
}