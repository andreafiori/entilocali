<?php

namespace UserTests\Model;

use SetupTest\TestSuite;
use Zend\Session\Container as SessionContainer;

class UserSession {
	
}

class UserLoginSessionTest extends TestSuite
{
	private $userSession;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->userSession = new SessionContainer();
	}
		
	public function testSessionIsWorking()
	{
		$this->userSession->record = array("name"=>"John", "surname"=>"Doe", "email"=>"johndoe@jdoemail.com");
		
		$this->assertTrue( is_array($this->userSession->record) );
	}
}