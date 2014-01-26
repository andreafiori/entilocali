<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsFormSetter;

class PostsFormSetterTest extends TestSuite
{
	private $setupManager;
	private $postsFormSetter;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->postsFormSetter = new PostsFormSetter($this->setupManager);
	}
	
	public function testSetTitle()
	{
		$this->postsFormSetter->setFormTitle();
	}
	
	public function testSetFormDescription()
	{
		$this->postsFormSetter->setFormDescription();
	}
}