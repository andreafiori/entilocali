<?php

namespace SetupTest;

use Setup\SetupManagerAlwaysToLoad;

/**
 * Manage Object with a record to load every time 
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerAlwaysToLoadTest extends TestSuite
{
	private $setupManagerAlwaysToLoad;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerAlwaysToLoad = new SetupManagerAlwaysToLoad();
	}

	public function testSetClassName()
	{
		$this->assertNotEmpty($this->setupManagerAlwaysToLoad->setClassName("Posts\\Model\\PostsQueryBuilder"));
	}

	public function testGetRecord()
	{
		$this->setupManagerAlwaysToLoad->setClassName("Posts\\Model\\PostsQueryBuilder");
		
		$this->assertTrue( is_array($this->setupManagerAlwaysToLoad->getRecord() ) );
	}
}