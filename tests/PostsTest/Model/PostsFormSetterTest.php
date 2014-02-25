<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Backend\Form\Setter\PostsFormSetter;

/**
 * @author Andrea Fiori
 * @since  27 January 2014
 */
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
		$this->postsFormSetter->setTitle();
	}
	
	public function testSetDescription()
	{
		$this->postsFormSetter->setDescription();
	}
}