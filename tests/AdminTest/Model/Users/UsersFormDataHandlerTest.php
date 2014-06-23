<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\UsersFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
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
        $this->assertTrue( is_string($this->usersFormDataHandler->getFormAction()) );
        
        $this->assertTrue( is_string($this->usersFormDataHandler->getFormAction(array( array('id'=>'1') ))) );
    }
}