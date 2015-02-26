<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use Admin\Model\Logs\LogsWriter;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Admin\Model\FormData\FormDataCrudHandler;
use Zend\Session\Container as SessionContainer;

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
        if (!$this->checkLogin()) {
            return $this->redirect()->toRoute('login');
        }

        $appServiceLoader = $this->recoverAppServiceLoader();
        
        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview'); // login to preview form
        }

        foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
        }

        $userDetails = $this->recoverUserDetails();

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

        $templateBackendDir = 'backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $this->layout()->setVariables(array(
            'baseUrl'           => $baseUrl,
            'userDetails'       => $userDetails,
            'preloadResponse'   => $appServiceLoader->recoverServiceKey('configurations', 'preloadResponse'),
            'templateBackendDir' => $templateBackendDir,
            'templatePartial'   => $templateBackendDir.$routerManagerHelper->getRouterManger()->getTemplate(1),
            'passwordPreviewArea' => $this->hasPasswordPreviewArea($configurations),
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
        if (!$this->checkLogin()) {
            return $this->redirect()->toRoute('login');
        }

        /* Must be a POST request */
        if (!$this->getServiceLocator()->get('request')->isPost()) {
            return $this->redirect()->toRoute('login');
        }

        $appServiceLoader = $this->recoverAppServiceLoader();

        $input = array_merge(
            $appServiceLoader->getProperties(),
            $appServiceLoader->recoverService('configurations'),
            array(
                'userDetails'  => $this->recoverUserDetails(),
            )
        );

        $formDataCrudHandler = new FormDataCrudHandler();
        $formDataCrudHandler->setInput($input);
        $formDataCrudHandler->setFormCrudHandler($this->params()->fromRoute('form_post_handler'));

        $crudHandlerObject = $formDataCrudHandler->detectCrudHandlerClassMap(
            $appServiceLoader->recoverServiceKey('moduleConfigs', 'formdata_crud_classmap')
        );

        /**
         * @var \Admin\Model\FormData\CrudHandlerAbstract $crudHandler
         */
        $crudHandler = new $crudHandlerObject($input);
        $crudHandler->setConnection($appServiceLoader->recoverService('entityManager')->getConnection());
        $crudHandler->setOperation($this->params()->fromRoute('operation'));
        $crudHandler->setLogsWriter( new LogsWriter($crudHandler->getConnection()) );
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