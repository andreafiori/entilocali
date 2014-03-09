<?php

namespace BackendTest\Controller;

use Backend\Controller\BackendController;
use SetupTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
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
		
		ServiceLocatorFactory::setInstance( $this->getServiceManager() );
		
		$this->controller = new BackendController();
		$this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
		$this->controller->setEvent($this->event);
		$this->controller->setServiceLocator($this->serviceManager);
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');

		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();

		$this->assertEquals(200, $response->getStatusCode());
	}
}