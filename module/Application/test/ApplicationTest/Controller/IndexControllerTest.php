<?php

namespace CommentTest\Controller;

use CommentTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
    	$this->controller = new IndexController();
    	$this->request    = new Request();
    	$this->routeMatch = new RouteMatch(array('controller' => 'index'));
    	$this->event      = new MvcEvent();
    	
        $serviceManager = Bootstrap::getServiceManager();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();

        $this->event->setRouter( HttpRouter::factory($routerConfig) );
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }
    
    public function testIndexActionCanBeAccessed()
    {
    	$this->routeMatch->setParam('action', 'index');

    	$result = $this->controller->dispatch($this->request);
    	
    	$this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
