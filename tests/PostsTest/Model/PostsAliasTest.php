<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsAlias;

/**
 * @author Andrea Fiori
 * @since  24 February 2014
 */
class PostsAliasTest extends TestSuite
{
	private $setupManager;
	
	private $postsAlias;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->postsAlias = new PostsAlias($this->setupManager);
	}
	
	public function testSetRecord()
	{
		$this->postsAlias->setRecord();
		
		$this->assertNotEmpty($this->postsAlias->getRecord());
	}
}