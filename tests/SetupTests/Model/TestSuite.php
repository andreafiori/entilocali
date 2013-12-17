<?php

namespace SetupTests\Model;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTests\ServiceManagerGrabber;
use Zend\ServiceManager\ServiceManager;

class TestSuite extends \PHPUnit_Framework_TestCase
{
	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	protected $serviceManager;
	
	public function setUpService()
	{
		$serviceManagerGrabber = new ServiceManagerGrabber();
		$this->serviceManager = $serviceManagerGrabber->getServiceManager();
		
		$this->request    = new Request();
		$this->routeMatch = new RouteMatch(array('controller' => 'index'));
		
		$config = $this->serviceManager->get('Config');
		$routerConfig = isset($config['router']) ? $config['router'] : array();
		
		$this->event      = new MvcEvent();
		$this->event->setRouter( HttpRouter::factory($routerConfig) );
		$this->event->setRouteMatch($this->routeMatch);
	}
	
	/**
	 * This is dirty!
	 * Cannot move this class on production \ module:
	 * I put a simple test here
	 */
	public function testSetupService()
	{
		$this->setUpService();
		$this->assertTrue($this->serviceManager instanceof ServiceManager);
	}
}