<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;
use ApplicationTest\ServiceManagerGrabber;
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
	
	/**
	 * @expectedException \Setup\NullException
	 */
	public function testSetConfigurationsLaunchException()
	{
		$this->assertFalse($this->setupManager->setConfigurations());
		
		$this->setupManager->setConfigRepository( $this->getConfigRepository() );
	}
		
		private function getConfigRepository()
		{
			return new ConfigRepository($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		}
}