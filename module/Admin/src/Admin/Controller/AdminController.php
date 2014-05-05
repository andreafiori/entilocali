<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\ClientStatic;

/**
 * Backend Main Controller
 * 
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AdminController extends AbstractActionController
{
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $configurations = $this->CommonSetupPlugin()->recoverConfigurationsRecord();
 
        foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
        }
        
        $this->layout()->setVariable('preloadResponse', $configurations['preloadResponse']);
        //$this->layout()->setVariable('templatePartial', $configurations['template_path'].$templatePartial);
        
        //$this->layout('backend/templates/default/login.phtml');
        $this->layout('backend/templates/default/backend.phtml');
    	return new ViewModel();
    }
    
}
