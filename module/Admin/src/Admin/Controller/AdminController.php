<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Admin\Model\Users\UserFormAuthentication;
use Zend\Session\Container as SessionContainer;
use Admin\Model\FormData\FormDataCrudHandler;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

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
    private $authservice;
    private $form;
    
    public function indexAction()
    {
        /* Check login */
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

        $session = new SessionContainer();
        
        $userDetails = new \stdClass();
        $userDetails->id = $session->offsetGet('id');
        $userDetails->name = $session->offsetGet('name');
        $userDetails->surname = $session->offsetGet('surname');
        
        $this->layout()->setVariable('baseUrl', $this->baseUrl);
        $this->layout()->setVariable('translator', $this->input['translator']);
        $this->layout()->setVariable('userDetails', $userDetails);
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

        $formDataCrudHandler = new FormDataCrudHandler();
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
                        'formsetter'             => trim($this->params()->fromRoute('formsetter')),
                        'tablesetter'            => trim($this->params()->fromRoute('tablesetter')),
                        'formdata_classmap'      => $this->config['formdata_classmap'],
                        'formdata_crud_classmap' => $this->config['formdata_crud_classmap'],
                        'datatables_classmap'    => $this->config['datatables_classmap'],
                    )
                )
            );
            
            $this->baseUrl = sprintf('%s://%s%s', $this->input['uri']->getScheme(), $this->input['uri']->getHost(), $this->input['request']->getBaseUrl()).'/admin/main/'.$this->params()->fromRoute('lang').'/';
            
            $this->input = array_merge($this->input, array("baseUrl" => $this->baseUrl));
        }

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function loginAction()
    {
        /* if already login, redirect to success page */
        try {
            if ($this->getAuthService()->hasIdentity()) {
                return $this->redirect()->toRoute('admin');
            }
        } catch (Exception $e) {
            return $this->redirect()->toRoute('admin');
        }
        
        $this->layout()->setVariable('form',     $this->getUserFormAuthentication());
        $this->layout()->setVariable('messages', $this->flashMessenger()->getMessages());
        $this->layout('backend/templates/default/login.phtml');
        
        return new ViewModel();
    }
    
    /**
     * @return type
     * @throws Exception
     */
    public function authenticateAction()
    {
        $form       = $this->getUserFormAuthentication();
        $redirect   = 'login';
        
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));
         
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }
                
                if ($result->isValid()) {
                    $redirect = 'admin';
                    
                    // set session timeout
                    $this->getSessionStorage()
                         ->setRememberMe();
                    
                    //set storage again
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // get user details
                    $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')) );
                    $usersGetterWrapper->setInput( array('username' => $request->getPost('username'), 'password' => $request->getPost('password'), 'limit'=>1) );
                    $usersGetterWrapper->setupQueryBuilder();
                    
                    $records = $usersGetterWrapper->getRecords();
                    if (isset($records)) {
                        $records = $records[0];
                        
                        // set ACL using session container
                        $sessionContainer = new SessionContainer();
                        $sessionContainer->offsetSet('id', $records['id']);
                        $sessionContainer->offsetSet('name', $records['name']);
                        $sessionContainer->offsetSet('surname', $records['surname']);
                        $sessionContainer->offsetSet('email', $records['email']);

                    } else {
                        throw new Exception('Cannot get user details after login');
                    }
                }
            } else {
                // TODO: after 3 failures the login form must show captcha...
                $sessionContainer = new Container();
                $loginFailures = $sessionContainer->offsetGet('loginFailures');
                $sessionContainer->offsetSet('loginFailures', $loginFailures);
                
                foreach($form->getMessages() as $message) {
                    $this->flashmessenger()->addMessage(print_r($message,1));
                }
            }
        }
        
        return $this->redirect()->toRoute($redirect, array("lang" => 'it'));
    }
    
    public function logoutAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();
            $this->flashmessenger()->addMessage("Uscita dall'area di amministrazione");
        }
        
        return $this->redirect()->toRoute('login');
    }
    
        /**
         * @return \Zend\Authentication\AuthenticationService
         */
        private function getAuthService()
        {
            if (!$this->authservice) {
                $this->authservice = $this->getServiceLocator()->get('AuthService');
            }

            return $this->authservice;
        }

        /**
         * @return \Admin\Model\MyAuthStorage
         */
        private function getSessionStorage()
        {
            if (!$this->storage) {
                $this->storage = $this->getServiceLocator()->get('Admin\Model\MyAuthStorage');
            }

            return $this->storage;
        }

        /**
         * @return \Admin\Model\Users\UserFormAuthentication
         */
        private function getUserFormAuthentication()
        {
            if (!$this->form) {
                $this->form = new UserFormAuthentication();
            }

            return $this->form;
        }
}
