<?php

namespace UsersTest\Model;

use SetupTest\TestSuite;
use Users\Model\UsersGetter;

/**
 * @author Andrea Fiori
 * @since  22 January 2014
 */
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
		$this->assertTrue( is_array($this->usersGetter->getUser( array("id"=>1) )) );
	}
}