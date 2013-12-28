<?php

namespace SetupTest\Model;

use SetupTests\Model\TestSuite;
use Setup\Model\SetupManager;
use ServiceLocatorFactory;

class SetupManagerTest extends TestSuite
{
	private $setupManager;
	private $controller;

	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager();
	}
	
	public function testSetInput()
	{
		$this->setupManager->setInput(array('channel'=>1,'isbackend'=>0));
		$this->assertTrue( is_array($this->setupManager->getInput()) );
	}

	public function testSetEntityManager()
	{
		ServiceLocatorFactory\ServiceLocatorFactory::setInstance( new \Zend\ServiceManager\ServiceManager() );
		$this->setupManager->setEntityManager( ServiceLocatorFactory\ServiceLocatorFactory::getInstance() );
	}
}