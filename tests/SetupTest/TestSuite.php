<?php

namespace SetupTest;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTest\ServiceManagerGrabber;
use Setup\NullException;
use Setup\SetupManager;


class TestSuite extends \PHPUnit_Framework_TestCase
{
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
		
		$this->event = new MvcEvent();
		$this->event->setRouter( HttpRouter::factory($routerConfig) );
		$this->event->setRouteMatch($this->routeMatch);
		
		$this->setEntityManagerMock();
	}

	protected function getDoctrineEntityManager()
	{
		if (!$this->getServiceManager()) {
			throw new NullException('Service Manager is not set');
		}
		
		return $this->getServiceManager()->get('\Doctrine\ORM\EntityManager');
	}

	protected function getEntityManagerMock()
	{
		if (!$this->entityManagerMock) {
			$this->entityManagerMock = $this->setEntityManagerMock();
		}
		
		return $this->entityManagerMock;
	}

	protected function getServiceManager()
	{
		return $this->serviceManager;
	}

	/**
	 * Mock Entity Manager Repository main methods
	 */
	protected function setEntityManagerMock()
	{
		$configuration = $this->getMockBuilder('\Doctrine\ORM\Configuration')
						   	  ->getMock();
		
		$connection = $this->getMockBuilder('\Doctrine\DBAL\Connection')
						   ->disableOriginalConstructor()
						   ->getMock();
		
		$query = $this->getMock('\Setup\DoctrineQueryForMock', array('setParameters', 'getResult'), array(), '', false);
		
		$query->expects($this->any())
			  ->method('setParameters')
			  ->will($this->returnValue(true));
		
		$query->expects($this->any())
			  ->method('getResult')
			  ->will($this->returnValue( array("id"=>1, "myResult" => "here it is!") ));
		
		$this->entityManagerMock = $this->getMock('\Doctrine\ORM\EntityManager', array('getRepository', 'getClassMetadata', 'persist', 'flush', 'create', 'createQuery', 'getConnection', 'getConfiguration'), array(), '', false);
		
		$this->entityManagerMock
			 ->expects($this->any())
			 ->method('getRepository')
			 ->will($this->returnValue(true));
		
		$this->entityManagerMock
			 ->expects($this->any())
			 ->method('getClassMetadata')
			 ->will($this->returnValue((object)array('name' => 'aClass')));
		
		$this->entityManagerMock
			->expects($this->any())
			->method('persist')
			->will($this->returnValue(true));

		$this->entityManagerMock
			->expects($this->any())
			->method('flush')
			->will($this->returnValue(true));
		
		$this->entityManagerMock
			 ->expects($this->any())
			 ->method('getConfiguration')
			 ->will($this->returnValue($configuration));
		
		$this->entityManagerMock
			 ->expects($this->any())
			 ->method('createQuery')
			 ->will($this->returnValue($query));
		
		$this->entityManagerMock
			 ->expects($this->any())
		 	 ->method('getConnection')
			 ->will($this->returnValue($connection));
		
		$this->entityManagerMock
			 ->expects($this->any())
			 ->method('getResult')
			 ->will($this->returnValue( array("id" => 1,"myResult" => 'MyResult')) );

		return $this->entityManagerMock;
	}

	protected function getSetupManager()
	{
		$setupManager = new SetupManager( array('channelId' => array(1, 0), 'isbackend' => 0) );
		$setupManager->setEntityManager($this->getEntityManagerMock());

		//$setupManager->getSetupManagerConfigurations()->setConfigRepository(new ConfigRepository( $setupManager->getEntityManager()) );
		//$setupManager->getSetupManagerConfigurations()->setConfigurations( array('channelId' => array(1,0), 'isbackend' => 0) );
		return $setupManager;
	}

	/**
	 * @test
	 */
	public function testThisFile()
	{
		$this->assertTrue( true );
	}
}