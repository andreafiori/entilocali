<?php

namespace SetupTest\Model;

use SetupTests\Model\TestSuite;
use Setup\Model\SetupManager;
use Application\Controller\IndexController;

class SetupManagerTest extends TestSuite {
	
	private $setupManager;
	private $setupManagerController;
	
	protected function setUp()
	{
		parent::setUp();
		
		$setupManagerController = new IndexController();

		$this->setupManager = new SetupManager($setupManagerController);
	}
	
	public function testFail()
	{
		$this->fail("This will fail");
	}
}