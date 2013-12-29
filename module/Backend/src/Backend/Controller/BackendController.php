<?php

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;

/**
 * Backend controller
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class BackendController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupManager = new SetupManager($this);
    	$setupManager->setEntityManager( $this->getServiceLocator()->get('entityManagerService') );
    	$setupManager->setInput( 
    		array(
    			'channel'	=> 1,
    			'isbackend' => 0,
    			'controller' => $this->params()->fromRoute('controller'),
    			'action'	 => $this->params()->fromRoute('action'),
    			'languageAbbreviation' => strtolower( $this->params()->fromRoute('lang') )
    		)
    	);
		$setupObjectRecord = $templateData = $setupManager->setSetupRecord();
		
		$templateToRender = 'backend/templates/default/backend.phtml';
		//$templateToRender = 'backend/templates/default/login.phtml';
        
        $this->layout()->setVariable("templateData", $setupObjectRecord);
        $this->layout($templateToRender);
        
        $viewModel = new ViewModel();
        $viewModel->setTerminal(false);
        return $viewModel;
	}
}