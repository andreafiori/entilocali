<?php

namespace SetupTests\Model;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTests\ServiceManagerGrabber;
use Zend\ServiceManager\ServiceManager;

class TestSuite extends \PHPUnit_Framework_TestCase {

	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	protected $serviceManager;
	
	protected $emMock, $doctrine;
	
	protected function setUp()
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
		
		$this->setEntityManagerMock();
		$this->setDoctrineMock();
	}
		
	/**
	 * This simple test allow us to not let this file without tests...
	 */
	public function testServiceManagerIsSet()
	{
		$this->assertTrue($this->serviceManager instanceof ServiceManager);
	}
		
		/**
		 * Set Entity Manager Mock object
		 */
		protected function setEntityManagerMock()
		{
			$this->emMock = $this->getMock('EntityManager', array('persist', 'flush'));
			
			$this->emMock
				->expects($this->any())
				->method('persist')
				->will($this->returnValue(true));

			$this->emMock
				->expects($this->any())
				->method('flush')
				->will($this->returnValue(true));
		}
		
		/**
		 * Set Doctrine Mock object
		 */
		protected function setDoctrineMock()
		{
			$this->doctrine = $this->getMock('Doctrine', array('getEntityManager'));
			$this->doctrine
				->expects($this->any())
				->method('getEntityManager')
				->will($this->returnValue($this->emMock));
		}
}