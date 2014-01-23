<?php

namespace UsersTest\Model;

use SetupTest\TestSuite;
use Users\Model\UsersQueryBuilder;
use Setup\SetupManager;

class UsersQueryBuilderTest extends TestSuite
{
	private $setupManager;
	private $usersQueryBuilder;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = new $this->getSetupManager();

		$this->usersQueryBuilder = new UsersQueryBuilder();
		$this->usersQueryBuilder->setSetupManager($this->setupManager);
	}

	public function testSetQueryBasic()
	{
		$this->usersQueryBuilder->setQueryBasic();

		$this->assertNotEmpty($this->usersQueryBuilder->getQueryBasic());
	}
	
	public function testGetQueryResult()
	{
		$this->usersQueryBuilder->setQueryBasic();
	
		$this->assertTrue( is_array($this->usersQueryBuilder->getSelectResult()) );
	}
}