<?php

namespace BackendTest\Controller;

use Backend\Controller\BackendController;
use SetupTest\TestSuite;

/**
 * TODO: test controllers with the dedicated class object 
 * @author Andrea Fiori
 * @since  07 January 2014
 */
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
		$this->routeMatch->setParam('lang', 'it');
		//$result = $this->controller->dispatch($this->request);
		$this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
	}
}