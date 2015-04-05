<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Application\Model\FrontendControllerSetup;
use Zend\Session\Container as SessionContainer;
use Zend\Http\Client;

/**
 * Frontend main controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview'); // login to preview form
        }

        $sezioni = $this->getServiceLocator()->get('SezioniRecords');

        $routerManager = new RouterManager($configurations);
        $routerManager->setIsBackend(0);
        $routerManager->setRouteMatchName( $appServiceLoader->recoverServiceKey('moduleConfigs', 'fe_router') );

        $input = array_merge(
            $configurations,
            $appServiceLoader->recoverService('UserInterfaceConfigurations')->getConfigurations(),
            $appServiceLoader->getProperties(),
            array(
                'category'  => trim($this->params()->fromRoute('category')),
                'title'     => trim($this->params()->fromRoute('title')),
            )
        );

        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();

        $varsFromModel = $routerManagerHelper->getRouterManger()->getOutput('export');

        if (method_exists($this->getRequest(), 'getServer')) {
            $serverVars = $this->getRequest()->getServer();
        } else $serverVars = null;

        $templateDir = 'frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'];
        if (isset($varsFromModel['basiclayout'])) {
            $basicLayout = $templateDir.$varsFromModel['basiclayout'];
        } else {
            $basicLayout = $input['basiclayout'];
        }

        try {
            $phpRenderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        } catch(\Zend\ServiceManager\Exception\ServiceNotFoundException $e) {
            $phpRenderer = null;
        }

        $this->layout()->setVariables( array_merge($varsFromModel, $input) );

        $this->layout()->setVariables( array(
            'sezioni'               => $sezioni,
            'templateDir'           => $templateDir,
            'maindata'              => $routerManagerHelper->getRouterManger()->getRecords(),
            'preloadResponse'       => isset($input['preloadResponse']) ? $input['preloadResponse'] : null,
            'currentUrl'            => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime'       => date("Y-m-d H:i:s"),
            'templatePartial'       => $input['template_path'].$routerManagerHelper->getRouterManger()->getTemplate(),
            'cssName'               => $sessionContainer->offSetGet('cssName'),
            'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
            'renderer'              => $phpRenderer
        ));

        $this->layout($basicLayout);

        return new ViewModel();
    }
}
