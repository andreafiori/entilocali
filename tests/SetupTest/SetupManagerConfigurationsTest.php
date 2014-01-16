<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManagerConfigurations;
use Config\Model\ConfigRepository;

class SetupManagerConfigurationsTest extends TestSuite {
	
	private $setupManagerConfigurations;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerConfigurations = new SetupManagerConfigurations();
	}
	
	public function testSetConfigRepository()
	{
		$this->setupManagerConfigurations->setConfigRepository( $this->getConfigRepository() );
		
		$this->assertTrue( $this->setupManagerConfigurations->getConfigRepository() instanceof ConfigRepository);
	}
	
	/**
	 * exception to launch: Config Repository is not set
	 * @expectedException \Setup\NullException
	 */
	public function testSetConfigurationsLaunchException()
	{
		$this->assertFalse($this->setupManagerConfigurations->setConfigurations());
		
		$this->setupManagerConfigurations->setConfigRepository( $this->getConfigRepository() );
	}

	public function testSetConfigurations()
	{
		$this->setupManagerConfigurations->setConfigRepository( $this->getConfigRepository() );
		$this->setupManagerConfigurations->setConfigurations();
		
		$this->assertNotEmpty( $this->setupManagerConfigurations->getConfigurations() );
	}
	
		private function getConfigRepository()
		{
			return new ConfigRepository($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		}
}