<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\ApiAuthenticator;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
class ApiAuthenticatorTest extends TestSuite
{
    private $apiAuthenticator;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiAuthenticator = new ApiAuthenticator($this->getEntityManagerMock());
    }
    
    public function testSetUsersGetterWrapper()
    {
        $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getEntityManagerMock()) );
        
        $this->apiAuthenticator->setUsersGetterWrapper($usersGetterWrapper);
        
        $this->assertInstanceOf('Admin\Model\Users\UsersGetterWrapper', $this->apiAuthenticator->getUsersGetterWrapper());
    }
}