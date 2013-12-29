<?php

namespace SetupTests\Model;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTests\ServiceManagerGrabber;

class TestSuite extends \PHPUnit_Framework_TestCase {

	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	protected $serviceManager;
	
	protected $entityManagerMock, $doctrine;
	
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

	public function testServiceManagerIsSet()
	{
		$this->assertEquals(1, 1);
	}
		
		/**
		 * Set Entity Manager Mock object
		 */
		protected function setEntityManagerMock()
		{
			$this->entityManagerMock = $this->getMock('EntityManager', array('persist', 'flush'));
			
			$this->entityManagerMock
				->expects($this->any())
				->method('persist')
				->will($this->returnValue(true));

			$this->entityManagerMock
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