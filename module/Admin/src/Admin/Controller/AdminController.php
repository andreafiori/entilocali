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
    private $commonSetupPlugin;    
    private $configurations;
    private $input;
    private $baseUrl;
    
    public function indexAction()
    {
        // Check login
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        $this->initialize();
        
        $routerManager = new RouterManager($this->configurations);
        $routerManager->setRouteMatchName($this->config['be_router']);
        
        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($this->input);
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $output = $routerManagerHelper->getRouterManger()->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $this->layout()->setVariable('baseUrl', $this->baseUrl);
        $this->layout()->setVariable('preloadResponse', $this->configurations['preloadResponse']);
        $this->layout()->setVariable('templatePartial', 'backend/templates/'.$this->configurations['template_backend'].$routerManagerHelper->getRouterManger()->getTemplate(1));
        $this->layout('backend/templates/'.$this->configurations['template_backend'].'backend.phtml');
        
    	return new ViewModel();
    }
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function formpostAction()
    {
        // Check login and if POST request
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity() or 
            !$this->getServiceLocator()->get('request')->isPost() ) {
            return $this->redirect()->toRoute('login');
        }

        $this->initialize();

        $formDataCrudHandler = new \Admin\Model\FormData\FormDataCrudHandler();
        $formDataCrudHandler->setInput($this->input);
        $formDataCrudHandler->setFormCrudHandler($this->params()->fromRoute('form_post_handler'));
        
        $crudHandler = $formDataCrudHandler->detectCrudHandlerClassMap($this->config['formdata_crud_classmap']);
        $crudHandler = new $crudHandler($this->input);
        $crudHandler->setConnection($this->commonSetupPlugin->getEntityManager()->getConnection());
        $crudHandler->setOperation($this->params()->fromRoute('operation'));
        $crudHandler->performOperation();
        
        $output = $crudHandler->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }

        $this->layout('backend/templates/'.$this->configurations['template_backend'].'message.phtml');
        
        return new ViewModel();
    }

        /**
         * Setup Common Plugin, service locator and input
         */
        private function initialize()
        {
            $this->commonSetupPlugin  = $this->CommonSetupPlugin();
            $this->configurations     = $this->commonSetupPlugin->recoverConfigurationsRecord();
            $this->commonSetupPlugin->setConfigurationsVariables();
            
            $this->config = $this->getServiceLocator()->get('config');
            
            $this->input = $this->commonSetupPlugin->mergeInput( array_merge($this->configurations, array(
                        'formsetter'            => trim($this->params()->fromRoute('formsetter')),
                        'tablesetter'           => trim($this->params()->fromRoute('tablesetter')),
                    ), array(
                        'formdata_classmap'      => $this->config['formdata_classmap'],
                        'formdata_crud_classmap' => $this->config['formdata_crud_classmap'],
                        'datatables_classmap'    => $this->config['datatables_classmap'],
                    )
                )
            );
            
            $this->baseUrl = sprintf('%s://%s%s', $this->input['uri']->getScheme(), $this->input['uri']->getHost(), $this->input['request']->getBaseUrl()).'/admin/main/'.$this->params()->fromRoute('lang').'/';
            
            $this->input = array_merge($this->input, array("baseUrl" => $this->baseUrl));
        }
}
