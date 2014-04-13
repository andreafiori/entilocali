<?php

namespace ServiceLocatorFactoryTest;

use ServiceLocatorFactory\NullServiceLocatorException;
use ApplicationTest\TestSuite;

/**
 * Launch an exception
 * 
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class NullServiceLocatorExceptionTest extends TestSuite {
	
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