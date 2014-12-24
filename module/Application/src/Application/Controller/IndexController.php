<?php

namespace Application\Controller;

use Application\Controller\SetupAbstractController;
use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;

/**
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends SetupAbstractController
{
    /**
     * @var \Application\Controller\Plugin\CommonSetupPlugin
     */
    private $commonSetupPlugin;
    
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');
        foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
        }
        
        $input = array_merge(
            $configurations, 
            $this->getUserInterfaceConfigurationsArray(),
            $appServiceLoader->getProperties(),
            array(
                'category'  => trim($this->params()->fromRoute('category')),
                'title'     => trim($this->params()->fromRoute('title')),
            )
        );
        
        $routerManager = new RouterManager($configurations);
        $routerManager->setIsBackend(0);
        $routerManager->setRouteMatchName($appServiceLoader->recoverServiceKey('moduleConfigs', 'fe_router'));

        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $varsToExport = array_merge($routerManagerHelper->getRouterManger()->getOutput('export'), $input);
        if ( isset($varsToExport) ) {
            foreach($varsToExport as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $serverVars = $this->getRequest()->getServer();
        
        $this->layout()->setVariables( array(
            'maindata'          =>  $routerManagerHelper->getRouterManger()->getRecords(),
            'preloadResponse'   => isset($input['preloadResponse']) ? $input['preloadResponse'] : null,
            'currentUrl'        => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime'   => date("Y-m-d H:i:s"),
            'templatePartial'   => $input['template_path'].$routerManagerHelper->getRouterManger()->getTemplate(),
        ));
        
        $this->layout($input['basiclayout']);
        
        return new ViewModel();
    }
}
