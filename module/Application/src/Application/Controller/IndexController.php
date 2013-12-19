<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Setup\Model\SetupManager;

/**
 * Frontend main controller
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$setupController = new SetupManager($this);
    	$setupController->setObjectManager( $this->getServiceLocator()->get('entityManagerService') );
		
    	$setupObjectRecord = $setupController->setSetupRecord();
    	$this->layout($setupObjectRecord['basiclayout']);
    	$this->layout()->setVariable("templateData", $setupObjectRecord);

    	return new ViewModel();
    }
    
	    /**
	     * Check if controller and action exists
	     * @param string $controller
	     * @param string $action
	     * @return boolean
	    
	    private function validateDispatchable($controller, $action)
	    {
	    	$loader = $this->getServiceLocator()->get('ControllerLoader');
	    	if (!$loader->has($controller)) {
	    		return false;
	    	}

	    	$obj    = $loader->get($controller);
	    	$method = $obj::getMethodFromAction($action);
	    	
	    	if (!method_exists($obj, $method)) {
	    		return false;
	    	}
	    
	    	return true;
	    } $this->validateDispatchable($this->params()->fromRoute('controller'), 'index'); */

	    /**
	     * Check if template exists
	     * @param unknown $template
	     * @return boolean
	    
	    private function validateTemplate($template)
	    {
	    	$resolver = $this->getEvent()
					    	 ->getApplication()
					    	 ->getServiceManager()
					    	 ->get('Zend\View\Resolver\TemplatePathStack');
	    	
	    	if (false === $resolver->resolve($template)) {
	    		return false;
	    	}
	    	return true;
	    } */
}
