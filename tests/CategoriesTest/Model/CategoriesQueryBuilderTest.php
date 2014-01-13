<?php

namespace CategoriesTest\Model;

use SetupTest\TestSuite;
use Categories\Model\CategoriesQueryBuilder;

class CategoriesQueryBuilderTest extends TestSuite {
	
	private $categoriesQueryBuilder;

	protected function setUp()
	{
		parent::setUp();
		
		$this->categoriesQueryBuilder = new CategoriesQueryBuilder();
	}
	
	public function testSetQueryBasic()
	{
		$this->categoriesQueryBuilder->setQueryBasic();
		
		$this->assertNotEmpty($this->categoriesQueryBuilder->getQueryBasic());
	}
}