<?php

namespace ApplicationTests\Controller;

use Application\Controller\IndexController;
use SetupTests\Model\TestSuite;

class IndexControllerTest extends TestSuite
{
	protected $controller;

	public function setUp()
	{
		$this->setUpService();
		
		$this->controller = new IndexController();
		$this->controller->setEvent($this->event);
		$this->controller->setServiceLocator($this->serviceManager);
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
		$this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
	}
}