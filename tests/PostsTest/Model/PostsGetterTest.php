<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsGetter;

class PostsGetterTest extends TestSuite {
	
	private $postsGetterWrapper;
	private $setupManager;
	
	public function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->postsGetterWrapper = new PostsGetter( $this->setupManager );
	}
		
	public function testGetPost()
	{
		$this->assertTrue( is_array($this->postsGetterWrapper->getPost()) );
	}
}