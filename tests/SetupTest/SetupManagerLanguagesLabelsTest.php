<?php

namespace SetupTest;

use Setup\SetupManagerLanguagesLabels;

/**
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerLanguagesLabelsTest extends TestSuite
{
	private $setupManagerLanguagesLabels;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerLanguagesLabels = new SetupManagerLanguagesLabels();
	}
	
	public function testSetLanguagesLabelsAsKeyValue()
	{
		$this->assertTrue( is_array($this->setupManagerLanguagesLabels->setInput( array("id"=>1) )) );
	}
}