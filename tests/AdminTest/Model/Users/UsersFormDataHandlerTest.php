<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\UsersFormDataHandler;

class UsersFormDataHandlerTest extends TestSuite
{
    private $usersFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->usersFormDataHandler = new UsersFormDataHandler( $this->getFrontendCommonInput() );
    }
    
    public function testGetFormAction()
    {
        $this->assertTrue(is_string($this->usersFormDataHandler->getFormAction()) );
    }
}