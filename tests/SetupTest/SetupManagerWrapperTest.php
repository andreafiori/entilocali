<?php

namespace SetupManagerWrapperTest;

use SetupTest\TestSuite;
use Setup\SetupManagerWrapper;
use Setup\SetupManager;

class SetupManagerWrapperTest extends TestSuite
{	
	private $setupManagerWrapper;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerWrapper = new SetupManagerWrapper( new SetupManager(array('channel'=>1,'isbackend'=>0)) );
	}
	
	public function testInitSetup()
	{
		$this->assertTrue( $this->setupManagerWrapper->initSetup() instanceof SetupManager);
	}
}