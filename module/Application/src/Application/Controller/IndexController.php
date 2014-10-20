<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;

/**
 * Frontend Controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    private $commonSetupPlugin;
    
    public function indexAction()
    {
        $this->commonSetupPlugin  = $this->CommonSetupPlugin();
        $configurations           = $this->commonSetupPlugin->recoverConfigurationsRecord();
        $config                   = $this->getServiceLocator()->get('config');
        $this->commonSetupPlugin->setConfigurationsVariables();

        $routerManager = new RouterManager($configurations);
        $routerManager->setRouteMatchName($config['fe_router']);
        
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
