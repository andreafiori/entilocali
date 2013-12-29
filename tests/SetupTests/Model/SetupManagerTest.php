<?php

namespace SetupTest\Model;

use SetupTests\Model\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;

class SetupManagerTest extends TestSuite
{
	private $setupManager;
	private $controller;

	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager(
				array('channel'=>1,'isbackend'=>0)
		);
	}
	
	public function testInput()
	{
		$input = $this->setupManager->getInput();
		
		$this->assertArrayHasKey('channel', $input);
	}
	
	/*
	public function testSetEntityManager()
	{
		ServiceLocatorFactory\ServiceLocatorFactory::setInstance( new \Zend\ServiceManager\ServiceManager() );
		$this->setupManager->setEntityManager( ServiceLocatorFactory\ServiceLocatorFactory::getInstance() );
	}
	*/
}