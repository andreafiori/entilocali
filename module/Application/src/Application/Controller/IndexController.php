<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\FrontendHelpers\FrontendRouter;

/**
 * Frontend Controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    private $commonSetupPlugin;
    private $input;
    
    public function indexAction()
    {     
        $this->commonSetupPlugin  = $this->CommonSetupPlugin();
        $configurations           = $this->commonSetupPlugin->recoverConfigurationsRecord();
        $config                   = $this->commonSetupPlugin->getServiceLocator()->get('config');
        
        $this->setInput();
        
        foreach($configurations as $key => $value) {
            $this->input['configurations'][$key] = $value;
            $this->layout()->setVariable($key, $value);
        }
        
        $frontendRouter = new FrontendRouter($configurations);
        $frontendRouter->setRouteMatchName($config['fe_router']);
        
        $frontendRouterObject = $frontendRouter->setRouteMatchInstance();
        $frontendRouterObject->setInput($this->input);
        $frontendRouterObject->setupFrontendRecord();
        
        $output = $frontendRouterObject->getOutput();
        if ( isset($output['export']) ) {
            foreach($output['export'] as $key => $value) {
                $this->layout()->setVariable($key, $value);
            }
        }
        
        $this->layout()->setVariable('maindata', $frontendRouterObject->getRecords());
        $this->layout()->setVariable('preloadResponse', $configurations['preloadResponse']);
        $this->layout()->setVariable('currentUrl', "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
        $this->layout()->setVariable('currentDateTime', date("Y-m-d H:i:s") );
        $this->layout()->setVariable('templatePartial', $configurations['template_path'].$frontendRouterObject->getTemplate());
        $this->layout($configurations['basiclayout']);
        
        return new ViewModel();
    }

        /**
         * Get Frontend input with objects and default vars set
         * 
         * @param \Application\Controller\Plugin\CommonSetupPlugin $commonSetupPlugin
         * @return array
         */
        private function setInput()
        {
            $this->input = array(
                'serviceLocator' => $this->commonSetupPlugin->getServiceLocator(),
                'entityManager'  => $this->commonSetupPlugin->getEntityManager(),
                'queryBuilder'   => $this->commonSetupPlugin->getQueryBuilder(),
                'redirect'       => $this->redirect(),
                'request'        => $this->getRequest(),
                'flashMessenger' => $this->flashMessenger(),
                
                'category'       => trim($this->params()->fromRoute('category')),
                'title'          => trim($this->params()->fromRoute('title')),
            );
            
            return $this->input;
        }
}
