<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
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
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        /* Preview password Area */
        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview');
        }

        $moduleConfigs = $appServiceLoader->recoverService('moduleConfigs');

        $userDetails = $this->recoverUserDetails();

        $uri = $this->getRequest()->getUri();
        $basePath = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $this->getRequest()->getBaseUrl().'/');
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

        $this->layout()->setVariables(array_merge(
            $configurations,
            $routerManagerHelper->getRouterManger()->getOutput('export'),
            array(
                'baseUrl'               => $baseUrl,
                'basePath'              => $basePath,
                'userDetails'           => $userDetails,
                'userRole'              => $userDetails->role,
                'preloadResponse'       => $appServiceLoader->recoverServiceKey('configurations', 'preloadResponse'),
                'templateBackendDir'    => $templateDir,
                'templatePartial'       => $templateDir.$routerManagerHelper->getRouterManger()->getTemplate(1),
                'formDataCommonPath'    => 'backend/templates/common/',
                'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
            )
        ));

        $this->layout()->setTemplate('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'backend.phtml');
    }
}