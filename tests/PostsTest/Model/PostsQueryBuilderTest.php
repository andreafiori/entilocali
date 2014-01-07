<?php

namespace PostsTest\Model;

use SetupTest\TestSuite;
use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * PostsQueryBuilderTest
 * @author Andrea Fiori
 * @since  03 January 2014
 */
class PostsQueryBuilderTest extends TestSuite
{
	private $postsQueryBuilder;
	
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = new SetupManager( array('channel' => 1, 'isbackend' => 0) );
		$this->setupManager->setEntityManager( $this->getServiceManager()->get('\Doctrine\ORM\EntityManager') );

		$this->postsQueryBuilder = new PostsQueryBuilder();
		$this->postsQueryBuilder->setSetupManager($this->setupManager);
	}

	public function testGetQueryResult()
	{
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setQueryBasic();
		
		$this->assertTrue( is_array($this->postsQueryBuilder->getSelectResult()) );
	}

	public function testSetCategoryName()
	{
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setCategoryName("Contatti");
		
		$this->assertArrayHasKey('cname', $this->postsQueryBuilder->getBindParameters());
	}
	
	public function testSetTitle()
	{
		$this->postsQueryBuilder->setTitle("Credits");
		$this->assertNotEmpty($this->postsQueryBuilder->getSelectQuery());
		$this->assertArrayHasKey('title', $this->postsQueryBuilder->getBindParameters());
	}

	public function testSetStatus()
	{
		$this->postsQueryBuilder->setStatus('DELETED');
		$this->assertNotEmpty($this->postsQueryBuilder->getSelectQuery());
		$this->assertArrayHasKey('status', $this->postsQueryBuilder->getBindParameters());
	}

	public function testAliasNotNull()
	{
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setQueryBasic();
		$this->postsQueryBuilder->setAliasNotNull();
		$this->assertNotEmpty($this->postsQueryBuilder->getSelectQuery());
	}
	
	/* TODO: test with mock?!
	public function testGetInsertResult()
	{
		$this->assertFalse($this->postsQueryBuilder->getInsertResult());
	}
	
	public function testGetUpdateResult()
	{
		
	}
	
	public function testGetDeleteResult()
	{
	
	}
	*/
		
	/* TESTS DQLQueryHelper abstract class methods */
	public function testsetDefaultFieldsSelect()
	{
		$this->postsQueryBuilder->setDefaultFieldsSelect('p, po.title');
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setQueryBasic();
		
		$this->assertNotEmpty( $this->postsQueryBuilder->getDefaultFieldsSelect() );
	}
	
	public function testSetSetupManager()
	{
		$this->assertTrue( $this->postsQueryBuilder->setSetupManager($this->postsQueryBuilder->getSetupManager()) instanceof SetupManager);
	}
	
	public function testAddToBindParameter()
	{
		$this->postsQueryBuilder->addToBindParameters('cname', 'prova');
		$this->assertArrayHasKey('cname', $this->postsQueryBuilder->getBindParameters());
	}
	
	public function testSetBindParameters()
	{
		$this->postsQueryBuilder->setBindParameters( array('language' => 1,'channel' => 1) );
		$this->assertTrue( is_array($this->postsQueryBuilder->getBindParameters()) );
	}
	
}