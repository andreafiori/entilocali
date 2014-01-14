<?php

namespace UsersTest\Model;

use SetupTest\TestSuite;
use Users\Model\UsersQueryBuilder;

class UsersQueryBuilderTest extends TestSuite
{
	private $usersQueryBuilder;

	protected function setUp()
	{
		parent::setUp();

		$this->usersQueryBuilder = new UsersQueryBuilder();
	}

	public function testSetQueryBasic()
	{
		$this->usersQueryBuilder->setQueryBasic();

		$this->assertNotEmpty($this->usersQueryBuilder->getQueryBasic());
	}
}