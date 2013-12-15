<?php

namespace SetupTest\Controller;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;
use ApplicationTests\ServiceManagerGrabber;
use Setup\Controller\SetupController;

class SetupControllerTest // extends PHPUnit_Framework_TestCase
{
	protected $controller;
	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	
	protected $serviceManager;

	public function setUp()
	{
		$serviceManagerGrabber = new ServiceManagerGrabber();
		$this->serviceManager = $serviceManagerGrabber->getServiceManager();
		
		$this->request    = new Request();
		$this->routeMatch = new RouteMatch(array('controller' => 'setup'));
		
		$config = $this->serviceManager->get('ApplicationConfig');
		$routerSetup = isset($config['router']) ? $config['router'] : array();
		
		$this->event      = new MvcEvent();
		$this->event->setRouter( HttpRouter::factory($routerSetup) );
		$this->event->setRouteMatch($this->routeMatch);
		
		$this->controller = new SetupController();
		$this->controller->setEvent($this->event);
		$this->controller->setServiceLocator($this->serviceManager);
	}
	
	public function testIndexActionCannotBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
		
		$result = $this->controller->dispatch($this->request);
		
		$this->assertEquals(500, $this->controller->getResponse()->getStatusCode());
	}
}