<?php

namespace CategoriesTest\Model;

use SetupTest\TestSuite;
use Categories\Model\CategoriesQueryBuilder;

class CategoriesQueryBuilderTest extends TestSuite
{
	private $setupManager;
	
	private $categoriesQueryBuilder;

	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = $this->getSetupManager();
		
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