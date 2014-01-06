<?php

namespace SetupTest;

use SetupTests\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;
use ApplicationTests\ServiceManagerGrabber;

class SetupManagerTest extends TestSuite
{
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager(
				array('channel' => 1,'isbackend' => 0)
		);
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
}