<?php

namespace ServiceLocatorFactoryTest;

use SetupTest\TestSuite;
use ServiceLocatorFactory\NullServiceLocatorException;

class NullServiceLocatorExceptioTest extends TestSuite {
	
	private $nullServiceLocatorException;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->nullServiceLocatorException = new NullServiceLocatorException();
	}
	
	public function testNullServiceLocatorExceptionIsInstanceOfException()
	{
		$this->assertInstanceOf('Exception', $this->nullServiceLocatorException);
	}
}