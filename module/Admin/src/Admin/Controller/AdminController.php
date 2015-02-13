<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container as SessionContainer;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Admin\Model\FormData\FormDataCrudHandler;

/**
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class AdminController extends SetupAbstractController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        /* Check login */
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }

        $appServiceLoader = $this->recoverAppServiceLoader();
        
        $configurations = $appServiceLoader->recoverService('configurations');
        foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
        }
        
        $session = new SessionContainer();
        $userDetails            = new \stdClass();
        $userDetails->id        = $session->offsetGet('id');
        $userDetails->name      = $session->offsetGet('name');
        $userDetails->surname   = $session->offsetGet('surname');
        $userDetails->role      = $session->offsetGet('role');
        $userDetails->acl       = $session->offsetGet('acl');
        
        $uri = $this->getRequest()->getUri();
        $baseUrl = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $appServiceLoader->recoverService('request')->getBaseUrl()).'/admin/main/'.$this->params()->fromRoute('lang').'/';
        $input = array_merge(
            $appServiceLoader->getProperties(),
            $appServiceLoader->recoverService('configurations'),
            array(
                'formsetter'             => trim($this->params()->fromRoute('formsetter')),
                'tablesetter'            => trim($this->params()->fromRoute('tablesetter')),
                'formdata_classmap'      => $appServiceLoader->recoverServiceKey('moduleConfigs', 'formdata_classmap'),
                'formdata_crud_classmap' => $appServiceLoader->recoverServiceKey('moduleConfigs', 'formdata_crud_classmap'),
                'datatables_classmap'    => $appServiceLoader->recoverServiceKey('moduleConfigs', 'datatables_classmap'),
                'userDetails'            => $userDetails,
                'baseUrl'                => $baseUrl,
            )
        );

        $routerManager = new RouterManager($appServiceLoader->recoverService('configurations'));
        $routerManager->setIsBackend(1);
        $routerManager->setRouteMatchName($appServiceLoader->recoverServiceKey('moduleConfigs', 'be_router'));

        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();

        $output = $routerManagerHelper->getRouterManger()->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $this->layout()->setVariables(array(
            'baseUrl'           => $baseUrl,
            'userDetails'       => $userDetails,
            'preloadResponse'   => $appServiceLoader->recoverServiceKey('configurations', 'preloadResponse'),
            'templatePartial'   => 'backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').$routerManagerHelper->getRouterManger()->getTemplate(1),
        ));
        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'backend.phtml');
        
    	return new ViewModel();
    }
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function formpostAction()
    {
        /* Check login */
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity() ) {
            return $this->redirect()->toRoute('login');
        }

        /* Must be a POST request */
        if (!$this->getServiceLocator()->get('request')->isPost()) {
            return $this->redirect()->toRoute('login');
        }

        $appServiceLoader = $this->recoverAppServiceLoader();

        $formDataCrudHandler = new FormDataCrudHandler();
        $formDataCrudHandler->setInput($appServiceLoader->getProperties());
        $formDataCrudHandler->setFormCrudHandler($this->params()->fromRoute('form_post_handler'));

        $crudHandlerObject = $formDataCrudHandler->detectCrudHandlerClassMap($appServiceLoader->recoverServiceKey('moduleConfigs', 'formdata_crud_classmap'));

        $crudHandler = new $crudHandlerObject($appServiceLoader->getProperties());
        $crudHandler->setConnection($appServiceLoader->recoverService('entityManager')->getConnection());
        $crudHandler->setOperation($this->params()->fromRoute('operation'));
        $crudHandler->performOperation();

        $output = $crudHandler->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }

        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'message.phtml');
        
        return new ViewModel();
    }        
}