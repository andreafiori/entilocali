<?php

namespace ApplicationTest\Model;

use Application\Model\User;
use PHPUnit_Framework_TestCase;

class UserTest extends PHPUnit_Framework_TestCase
{
	private $arraySampleUser;
	
	public function setUp()
	{
		$this->arraySampleUser = array(
					'id' => 123,
					'name' => 'John Doe',
					'email' => 'johndoe@johndoemail.com'
			);
	}
	
    public function testCommentInitialState()
    {
        $user = new User();
        $this->userNullAssertions($user);
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
    	$data = $this->arraySampleUser;
    	
        $user = new User();
        $user->exchangeArray($data);

        $this->assertSame($data['id'], $user->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $user->name, '"name" was not set correctly');
        $this->assertSame($data['email'], $user->email, '"email" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $user = new User();
        $user->exchangeArray( $this->arraySampleUser );
        $user->exchangeArray(array());

        $this->userNullAssertions($user);
    }
	    
	    private function userNullAssertions(User $user)
	    {
	    	$this->assertNull($user->id, '"id" should have defaulted to null');
	        $this->assertNull($user->name, '"name" should have defaulted to null');
	        $this->assertNull($user->email, '"email" should have defaulted to null');
	    }

}
