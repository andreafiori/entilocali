<?php

namespace PostsTest\Model;

use Posts\Model\PostsGetterWrapper;
use Setup\SetupManager;
use SetupTest\TestSuite;
use Config\Model\ConfigRepository;

class PostsGetterWrapperTest extends TestSuite {
	
	private $postsGetterWrapper;
	private $setupManager;
	
	public function setUp()
	{
		parent::setUp();
		
		$this->setupManager = new SetupManager( array('channel' => 1, 'isbackend' => 0) );
		$this->setupManager->setEntityManager($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		$this->setupManager->setConfigRepository(new ConfigRepository($this->setupManager->getEntityManager()));
		$this->setupManager->setConfigurations();
		
		$this->postsGetterWrapper = new PostsGetterWrapper($this->setupManager);
	}
	
	public function testSetInput()
	{
		$this->postsGetterWrapper->setInput(array("language" => 1, "categoryName" => $this->setupManager->getInput('categoryName'),"helpers"=>1) );
		$this->assertArrayHasKey("language", $this->postsGetterWrapper->getInput());
	}
	
	public function testGetPost()
	{
		$this->assertTrue( is_array($this->postsGetterWrapper->getPost()) );
	}
}