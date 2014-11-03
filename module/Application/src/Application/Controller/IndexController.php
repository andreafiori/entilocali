<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;

/**
 * Frontend Controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    /** @var \Application\Controller\Plugin\CommonSetupPlugin **/
    private $commonSetupPlugin;
    
    public function indexAction()
    {
        $this->commonSetupPlugin  = $this->CommonSetupPlugin();
        $this->commonSetupPlugin->setApplicationServices();
        $this->commonSetupPlugin->setupConfigsFromDb( new ConfigGetterWrapper(new ConfigGetter($this->commonSetupPlugin->getEntityManager())));
        $this->commonSetupPlugin->setRouteMatchName();
        $this->commonSetupPlugin->setUserInterfaceConfigurations();
        
        $configurations           = $this->commonSetupPlugin->getConfigurations();
        $moduleConfig             = $this->commonSetupPlugin->getModuleConfigs();
        
        $this->commonSetupPlugin->setConfigurationsVariables();

        $routerManager = new RouterManager($configurations);
        $routerManager->setRouteMatchName($moduleConfig['fe_router']);
        
        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput(
            $this->commonSetupPlugin->mergeInput( 
                array_merge($configurations, 
                    array(
                        'category'  => trim($this->params()->fromRoute('category')),
                        'title'     => trim($this->params()->fromRoute('title')),
                    )
                )
            )
        );
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $output = $routerManagerHelper->getRouterManger()->getOutput('export');
        if ( isset($output) ) {
            foreach($output as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        if ( isset($output['basiclayout']) ) {
            $basicLayout = $configurations['template_path'].$output['basiclayout'];
        } else {
            $basicLayout = $configurations['basiclayout'];
        }
        
        $serverVars = $this->getRequest()->getServer();
        
        $this->layout()->setVariables( array(
            'maindata' =>  $routerManagerHelper->getRouterManger()->getRecords(),
            'preloadResponse' => $configurations['preloadResponse'],
            'currentUrl' => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime' => date("Y-m-d H:i:s"),
            'templatePartial' => $configurations['template_path'].$routerManagerHelper->getRouterManger()->getTemplate(),
        ));
        
        $this->layout($basicLayout);
        
        return new ViewModel();
    }
}
