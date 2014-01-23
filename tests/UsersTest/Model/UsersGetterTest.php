<?php

namespace UsersTest\Model;

use SetupTest\TestSuite;
use Users\Model\UsersGetter;

class UsersGetterTest extends TestSuite
{
	private $usersGetter;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->usersGetter = new UsersGetter( $this->getSetupManager() );
	}
	
	public function testGetUser()
	{
		$this->assertTrue( is_array($this->usersGetter->getUser()) );
	}
}