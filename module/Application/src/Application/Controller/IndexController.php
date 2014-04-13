<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Zend\Mvc\Controller\AbstractActionController;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientException;
use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Exception\ServerException;

/**
 * Frontend Main Controller
 * TODO: 
 *      preloader through REST call
 *      controller result
 *          meta tag
 *          template partial
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
        $routeMatch = $router->match($routeRequest);
        
        $client = new Client();
        $request = $client->createRequest('GET', $config['app_configs']['api_basic_url'].'setup');
        $response = $client->send($request)->json();

        $configurations = $response['data']['config'];
	foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
	}
        $this->layout()->setVariable('templatePartial', $configurations['template_path'].'homepage.phtml');
        $this->layout($configurations['basiclayout']);

        return new ViewModel();
    }
}
