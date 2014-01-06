<?php

namespace PostsTests\Model;

use Setup\SetupManager;
use SetupTests\TestSuite;
use Posts\Model\PostsRecordsHelper;
use Posts\Model\PostsQueryBuilder;

class PostsRecordsHelperTest extends TestSuite {

	private $postsRecordsHelper;
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = new SetupManager( array('channel' => 1, 'isbackend' => 0) );
		$this->setupManager->setEntityManager( $this->getServiceManager()->get('\Doctrine\ORM\EntityManager') );
		
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($this->setupManager);
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setQueryBasic();
	
		$this->postsRecordsHelper = new PostsRecordsHelper( $postsQueryBuilder->getSelectResult() );
		$this->postsRecordsHelper->setSetupManager($this->setupManager);
	}

	public function testSetAdditionalArrayElements()
	{
		$this->postsRecordsHelper->setAdditionalArrayElements();

		$records = $this->postsRecordsHelper->getPostsRecords();

		$this->assertTrue( is_array($records) );
	}
	
	public function testSortPostsByAlias()
	{
		$this->postsRecordsHelper->sortPostsByAlias();
		$this->assertTrue( is_array($this->postsRecordsHelper->getPostsRecords()) );
	}
}