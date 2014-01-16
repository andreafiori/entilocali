<?php

namespace SetupTest;

use Setup\SetupManagerPreload;

/**
 * Manage Object with a record to load every time 
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerPreloadTest extends TestSuite
{
	private $setupManagerPreload;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerPreload = new SetupManagerPreload();
	}

	public function testSetClassName()
	{
		$this->assertNotEmpty($this->setupManagerPreload->setClassName("Posts\\Model\\PostsQueryBuilder"));
	}

	public function testGetRecord()
	{
		$this->setupManagerPreload->setClassName("Posts\\Model\\PostsQueryBuilder");
		
		$this->assertTrue( is_array($this->setupManagerPreload->getRecord() ) );
	}
}