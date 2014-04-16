<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use GuzzleHttp\Client;

/**
 * Frontend Main Controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $services       = $this->getServiceLocator()->get('servicemanager');
        $config         = $services->get('config');
        $router         = $services->get('router');
        $routeRequest   = $services->get('request');
        $routeMatch     = $router->match($routeRequest);
        // $routeMatchName = $routeMatch->getMatchedRouteName();
        
        $client         = new Client();
        $setupRequest   = $client->createRequest('GET', $config['app_configs']['api_basic_url'].'setup');
        $setupResponse  = $client->send($setupRequest)->json();
        
        $configurations = $setupResponse['data']['config'];
	foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
	}
        
        /* Preloader */
        $preloadRequest  = $client->createRequest('GET', $config['app_configs']['api_basic_url'].'posts');
        $preloadCategories = $client->send($preloadRequest)->json();
        $preloadResponse = array();
        foreach($preloadCategories['data'] as $preload) {
            $preloadResponse[$preload['nomeCategoria']][] = $preload;
        }
        
        /* Main data */
        if ( !empty($this->params()->fromRoute('category')) or !empty($this->params()->fromRoute('title')) ) {
            $query = array( 'query' => array( "title" => $this->params()->fromRoute('title'), "category" => $this->params()->fromRoute('category')) );
            $mainControllerRequest  = $client->get($config['app_configs']['api_basic_url'].'posts', $query);
            $mainControllerResponse = $mainControllerRequest->json();
            $templatePartial = $mainControllerResponse['template'];
        }

        if ( isset($mainControllerResponse['data']) ) {
            $this->layout()->setVariable('maindata', $mainControllerResponse['data']);
        }
        
        $this->layout()->setVariable('preloadResponse', $preloadResponse);
        $this->layout()->setVariable('templatePartial', $this->templateExists($templatePartial) ? $configurations['template_path'].$templatePartial : $configurations['template_path'].'homepage.phtml');
        $this->layout($configurations['basiclayout']);

        return new ViewModel();
    }
    
        /**
         * @param string $template
         */
        private function templateExists($template)
        {
            $resolver = $this->getEvent()
                            ->getApplication()
                            ->getServiceManager()
                            ->get('Zend\View\Resolver\TemplatePathStack');

            if (false === $resolver->resolve($template) or !$template) {
                return false;
            }
            
            return true;
        }
}
