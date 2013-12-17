<?php

namespace ConfigTest\Controller;

use Config\Controller\ConfigController;
use SetupTests\Model\TestSuite;

class ConfigControllerTest extends TestSuite
{
	protected $controller;
	
	protected $serviceManager;

	public function setUp()
	{
		$this->setUpService();
		
		$this->controller = new ConfigController();
		$this->controller->setEvent($this->event);
		$this->controller->setServiceLocator($this->serviceManager);
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
		$result = $this->controller->dispatch($this->request);
		$this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
	}
}