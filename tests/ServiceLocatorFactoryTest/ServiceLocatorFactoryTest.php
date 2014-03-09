<?php

namespace ServiceLocatorFactoryTest;

use SetupTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Zend\ServiceManager\ServiceManager;

/**
 * Test the static class methods of ServiceLocatorFactory
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class ServiceLocatorFactoryTest extends TestSuite {

	protected function setUp()
	{
		parent::setUp();
	}
	
	public function testSetinstance()
	{
		ServiceLocatorFactory::setInstance( $this->getServiceManager() );
		$this->assertTrue( ServiceLocatorFactory::getInstance() instanceof ServiceManager);
	}
}