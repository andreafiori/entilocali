<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsGetter;

class PostsGetterTest extends TestSuite
{
	private $setupManager;

	private $postsGetterWrapper;

	public function setUp()
	{
		parent::setUp();

		$this->setupManager = $this->getSetupManager();
		
		$this->postsGetterWrapper = new PostsGetter( $this->setupManager );
	}
}