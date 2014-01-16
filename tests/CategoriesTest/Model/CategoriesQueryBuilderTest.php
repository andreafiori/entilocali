<?php

namespace CategoriesTest\Model;

use SetupTest\TestSuite;
use Categories\Model\CategoriesQueryBuilder;
use Setup\SetupManager;

class CategoriesQueryBuilderTest extends TestSuite
{
	private $setupManager;	
	private $categoriesQueryBuilder;

	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager( array('channel' => 1, 'isbackend' => 0) );
		$this->setupManager->setEntityManager( $this->getServiceManager()->get('\Doctrine\ORM\EntityManager') );
		
		$this->categoriesQueryBuilder = new CategoriesQueryBuilder();
		$this->categoriesQueryBuilder->setSetupManager( $this->setupManager );
	}

	public function testSetQueryBasic()
	{
		$this->categoriesQueryBuilder->setQueryBasic();
		
		$this->assertNotEmpty($this->categoriesQueryBuilder->getQueryBasic());
	}

	public function testGetQueryResult()
	{
		$this->categoriesQueryBuilder->setQueryBasic();
	
		$this->assertTrue( is_array($this->categoriesQueryBuilder->getSelectResult()) );
	}
}