<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Posts\Model\PostsRecordsHelper;
use Posts\Model\PostsQueryBuilder;

/**
 * @author Andrea fiori
 * @since  05 January 2014
 */
class PostsRecordsHelperTest extends TestSuite
{
	private $postsRecordsHelper;
	
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
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

		$this->assertNotEmpty($this->postsRecordsHelper->getPostsRecords());
	}

	public function testSortPostsByAlias()
	{
		$this->assertTrue( is_array($this->postsRecordsHelper->sortPostsByAlias(true)) );
	}
}