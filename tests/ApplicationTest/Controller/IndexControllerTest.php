<?php

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use SetupTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class IndexControllerTest //extends TestSuite
{
	protected $controller;

	protected function setUp()
	{
		parent::setUp();
		
		ServiceLocatorFactory::setInstance( $this->getServiceManager() );
		
		$this->controller = new IndexController();
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