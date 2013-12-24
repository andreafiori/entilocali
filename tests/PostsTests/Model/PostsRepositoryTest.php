<?php

namespace PostsTest\Model;

use Posts\Model\PostsRepository;
use SetupTests\Model\TestSuite;

class PostsRepositoryTest extends TestSuite {

	private $postsRepository;

	protected function setUp()
	{
		parent::setUp();
		
		$this->postsRepository = new PostsRepository($this->serviceManager->get('entityManagerService'));
	}

	public function testGetPosts()
	{
		$this->assertTrue( is_array($this->postsRepository->getPosts()) );
		$this->assertTrue( is_array($this->postsRepository->getPosts(array("id"=>1))) );
	}

}