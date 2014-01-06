<?php

namespace BackendTest\Controller;

use Backend\Controller\BackendController;

use SetupTests\TestSuite;

class BackendControllerTest extends TestSuite
{
	protected $controller;
	
	protected $serviceManager;

	public function setUp()
	{
		parent::setUp();
		
		$this->controller = new BackendController();
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
		//$result = $this->controller->dispatch($this->request);
		$this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
	}
}