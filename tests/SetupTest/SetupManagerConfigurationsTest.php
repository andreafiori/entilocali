<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManagerConfigurations;
use Config\Model\ConfigRepository;

class SetupManagerConfigurationsTest //extends TestSuite
{
	private $setupManagerConfigurations;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerConfigurations = new SetupManagerConfigurations();
	}
	
	public function testSetConfigRepository()
	{
		$this->setupManagerConfigurations->setEntityManager( $this->getEntityManagerMock() );
		$this->setupManagerConfigurations->setConfigRepository( $this->getConfigRepository() );

		$this->assertTrue( $this->setupManagerConfigurations->getConfigRepository() instanceof ConfigRepository);
	}

	public function testSetConfigurations()
	{
		$this->setupManagerConfigurations->setConfigRepository( $this->getConfigRepository() );
		$this->setupManagerConfigurations->setConfigurations( array("isbackend" => 0, "channelId" => array(1,0)) );
		
		$this->assertNotEmpty( $this->setupManagerConfigurations->getConfigurations() );
	}
	
		private function getConfigRepository()
		{
			return new ConfigRepository($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		}
}