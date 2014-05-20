<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AdminController extends AbstractActionController
{
    public function indexAction()
    {
        // Check login
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        $commonSetupPlugin  = $this->CommonSetupPlugin();
        $config             = $this->getServiceLocator()->get('config');
        $configurations     = $commonSetupPlugin->recoverConfigurationsRecord();
        $commonSetupPlugin->setConfigurationsVariables();        
        $input = $commonSetupPlugin->mergeInput( array_merge($configurations, array(
                'formsetter'   => trim($this->params()->fromRoute('formsetter')),
                'tablesetter'  => trim($this->params()->fromRoute('tablesetter')),
        )));

        $baseUrl = sprintf('%s://%s%s', $input['uri']->getScheme(), $input['uri']->getHost(), $input['request']->getBaseUrl()).'/admin/main/'.$this->params()->fromRoute('lang').'/';
        $input = array_merge($input, array("baseUrl" => $baseUrl));
        
        $routerManager = new RouterManager($configurations);
        $routerManager->setRouteMatchName($config['be_router']);
        
        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $output = $routerManagerHelper->getRouterManger()->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $templatePartial = $routerManagerHelper->getRouterManger()->getTemplate(1);
        $serverVars = $this->getRequest()->getServer();
        
        if ( !isset($templatePartial) ) {
            $dashboard = 'dashboard/dashboard.phtml';
            $templatePartial = $dashboard;
        }
        
        $this->layout()->setVariable('baseUrl', $baseUrl);
        $this->layout()->setVariable('preloadResponse', $configurations['preloadResponse']);
        $this->layout()->setVariable('templatePartial', 'backend/templates/'.$configurations['template_backend'].$templatePartial);
        $this->layout('backend/templates/'.$configurations['template_backend'].'backend.phtml');
        
    	return new ViewModel();
    }
    
    /**
     * TODO: 
     *      routing to fetch form posts
     */
    public function formpostAction()
    {
        return false;
    }
    
}
