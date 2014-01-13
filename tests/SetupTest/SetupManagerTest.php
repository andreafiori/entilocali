<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;
use ApplicationTest\ServiceManagerGrabber;

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
	
	public function testGetInput()
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

}