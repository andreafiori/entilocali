<?php

namespace PostsTest\Model;

use Posts\Model\PostsGetter;
use Setup\SetupManager;
use SetupTest\TestSuite;
use Config\Model\ConfigRepository;

class PostsGetterTest extends TestSuite {
	
	private $postsGetterWrapper;
	private $setupManager;
	
	public function setUp()
	{
		parent::setUp();
		
		$this->setupManager = new SetupManager( 
					array('channel' => 1, 'isbackend' => 0, "language" => 1, 
						"categoryName" => "Contatti","helpers"=>1) 
		);
		$this->setupManager->setEntityManager($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		$this->setupManager->getSetupManagerConfigurations()->setConfigRepository(new ConfigRepository($this->setupManager->getEntityManager()));
		$this->setupManager->getSetupManagerConfigurations()->setConfigurations();
		
		$this->postsGetterWrapper = new PostsGetter( $this->setupManager );
	}
		
	public function testGetPost()
	{
		$this->assertTrue( is_array($this->postsGetterWrapper->getPost()) );
	}
}