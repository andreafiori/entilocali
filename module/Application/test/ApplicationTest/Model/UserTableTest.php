<?php

namespace Application\Model;

use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class UserTableTest extends PHPUnit_Framework_TestCase
{
	private $sampleUser;
	
	public function setUp()
	{
		$this->sampleUser = array(
					'id' => 123,
					'name' => 'John Doe',
					'email' => 'johndoe@johndoemail.com'
			);
	}
	
    public function testFetchAllReturnsAllUsers()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $userTable = new UserTable($mockTableGateway);

        $this->assertSame($resultSet, $userTable->fetchAll());
    }
    
    public function testCanRetrieveACommentByItsEmail()
    {
        $user = new User();
        $user->exchangeArray( $this->sampleUser );

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $resultSet->initialize(array($user));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('email' => 'johndoe@johndoemail.com'))
                         ->will($this->returnValue($resultSet));

        $userTable = new UserTable($mockTableGateway);

        $this->assertSame($user, $userTable->getUserByEmail('johndoe@johndoemail.com'));
    }

    public function testCanDeleteAnAlbumByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('delete')
                         ->with(array('id' => 123));

        $userTable = new UserTable($mockTableGateway);
        $userTable->deleteUser(123);
    }
	/*
    public function testSaveUserWillInsertNewUserIfTheyDontAlreadyHaveAnId()
    {
        $userData = array('name' => 'John Doe', 'email' => 'johndoe@johnmail.com');
        $user = new User();
        $user->exchangeArray($userData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('insert')
                         ->with($this->returnValue($userData));
        
		$userTable = new UserTable($mockTableGateway);
		$userTable->saveUser($user);
    }

    public function testSaveUserWillUpdateExistingUsersIfTheyAlreadyHaveAnId()
    {
        $user = new User();
        $user->exchangeArray($this->sampleUser);
        
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new User());
        $resultSet->initialize(array($user));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with( array('email' => 'johndoe@johnmail.com') )
                         ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                         ->method('update')
                         ->with( $this->sampleUser, array('email' => 'johndoe@johnmail.com') );
        
        $userTable = new UserTable($mockTableGateway);
        $userTable->saveUser($user);
    }
    */
}