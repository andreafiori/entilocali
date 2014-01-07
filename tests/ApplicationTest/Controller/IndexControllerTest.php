<?php

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use SetupTest\TestSuite;

class IndexControllerTest extends TestSuite {

	protected $controller;

	protected function setUp()
	{
		parent::setUp();
		
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