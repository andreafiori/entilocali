<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsGetter;
use Posts\Model\PostsRecordsHelper;

/**
 * @author Andrea Fiori
 * @since  24 January 2014
 */
class PostsGetterTest extends TestSuite
{
	private $setupManager;

	private $postsGetter;

	public function setUp()
	{
		parent::setUp();

		$this->setupManager = $this->getSetupManager();
		
		$this->postsGetter = new PostsGetter( $this->setupManager );
	}
	
	public function testGetCompletePostRecord()
	{
		$this->assertTrue( is_array($this->postsGetter->getCompletePostRecord()) );
	}
	
	public function testGetPostsRecordsHelper()
	{
		$this->assertTrue( is_array($this->postsGetter->getPostsRecordsHelper(new PostsRecordsHelper(array("id"=>1)))) );
	}
}