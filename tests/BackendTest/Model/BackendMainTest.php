<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Model\BackendMain;

class BackendMainTest extends TestSuite
{	
	private $backendMain;

	public function setUp()
	{
		parent::setUp();
		
		$this->backendMain = new BackendMain($this->getSetupManager());
	}
	
	public function testSetRouter()
	{
		$this->assertEquals($this->backendMain->setRouter("formdata"), "formdata");
		$this->assertEquals($this->backendMain->getRouter(), "formdata");
	}
}