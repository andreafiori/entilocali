<?php

namespace SetupTest;

use SetupTests\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;
use ApplicationTests\ServiceManagerGrabber;
use Config\Model\ConfigRepository;

class SetupManagerTest extends TestSuite
{
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager(
				array('channel' => 1,'isbackend' => 0)
		);
		
		$this->setupManager->setEntityManager($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
	}
	
	public function testInput()
	{
		$input = $this->setupManager->getInput();
		
		$this->assertArrayHasKey('channel', $input);
	}
	
	public function testSetEntityManager()
	{
		$this->assertNotEmpty( ServiceManagerGrabber::getServiceConfig() );
	}
	
	public function testSetChannelId()
	{
		$this->setupManager->setChannelId();
		$this->assertEquals($this->setupManager->getChannelId(), 1);
	}
	
	public function testSetConfigRepository()
	{
		$this->setupManager->setConfigRepository( $this->getConfigRepository() );
		$this->assertTrue( $this->setupManager->getConfigRepository() instanceof ConfigRepository);
	}
	
	public function testSetConfigurations()
	{
		$this->assertFalse($this->setupManager->setConfigurations());
		
		$this->setupManager->setConfigRepository( $this->getConfigRepository() );
	}
		
		private function getConfigRepository()
		{
			return new ConfigRepository($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		}
}