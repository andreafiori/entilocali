<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsDatatable;

/**
 * @author Andrea Fiori
 * @since  03 January 2014
 */
class PostsDatatableTest extends TestSuite
{
	private $postsDatatable;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->postsDatatable = new PostsDatatable();
	}
	
	public function testSetTitle()
	{
		$this->assertEquals($this->postsDatatable->setTitle(), $this->postsDatatable->getTitle());
	}
}