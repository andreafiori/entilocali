<?php

namespace Admin\Controller;

use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
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
        if (!$this->checkLogin()) {
            return $this->redirect()->toRoute('login');
        }

        $appServiceLoader = $this->recoverAppServiceLoader();
        
        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        /* Preview password Area */
        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview');
        }

        /*
        $modules = $appServiceLoader->setupModules(new ModulesGetterWrapper(
            new ModulesGetter($appServiceLoader->recoverService('entityManager'))
        ));
        */

        $moduleConfigs = $appServiceLoader->recoverService('moduleConfigs');

        $userDetails = $this->recoverUserDetails();

        $uri = $this->getRequest()->getUri();

        $basePath = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $appServiceLoader->recoverService('request')->getBaseUrl().'/');
        $baseUrl = sprintf($basePath.'admin/main/'.$this->params()->fromRoute('lang').'/');

        $input = array_merge(
            $appServiceLoader->getProperties(),
            array(
                'formsetter'             => trim($this->params()->fromRoute('formsetter')),
                'tablesetter'            => trim($this->params()->fromRoute('tablesetter')),
                'formdata_classmap'      => $moduleConfigs['formdata_classmap'],
                'formdata_crud_classmap' => $moduleConfigs['formdata_crud_classmap'],
                'datatables_classmap'    => $moduleConfigs['datatables_classmap'],
                'userDetails'            => $userDetails,
                'baseUrl'                => $baseUrl,
                'basePath'               => $basePath,
            )
        );

        $routerManager = new RouterManager($appServiceLoader->recoverService('configurations'));
        $routerManager->setIsBackend(1);
        $routerManager->setRouteMatchName($appServiceLoader->recoverServiceKey('moduleConfigs', 'be_router'));

        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();

        $templateDir = 'backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $this->layout()->setVariables($configurations);
        $this->layout()->setVariables($routerManagerHelper->getRouterManger()->getOutput('export'));
        $this->layout()->setVariables(array(
            'baseUrl'               => $baseUrl,
            'basePath'              => $basePath,
            'userDetails'           => $userDetails,
            'userRole'              => $userDetails->role,
            'preloadResponse'       => $appServiceLoader->recoverServiceKey('configurations', 'preloadResponse'),
            'templateBackendDir'    => $templateDir,
            'templatePartial'       => $templateDir.$routerManagerHelper->getRouterManger()->getTemplate(1),
            'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
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
        // TODO: validate input
        $crudHandler->performOperation(); // TODO: pass raw post and raw files
        // TODO: log operation

        $this->layout()->setVariables($crudHandler->getOutput('export'));
        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'message.phtml');
        
        return new ViewModel();
    }
}