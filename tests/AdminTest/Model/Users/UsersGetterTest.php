<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\UsersGetter;

/**
 * @author Andrea Fiori
 * @since  16 June 2014
 */
class UsersGetterTest extends TestSuite
{
    private $usersGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->usersGetter = new UsersGetter($this->getEntityManagerMock());
    }
    
    public function testSetMainQuery()
    {
        $this->usersGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->usersGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->usersGetter->setId(1);
        
        $this->assertNotEmpty($this->usersGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetSurname()
    {
        $this->usersGetter->setSurname('Doe');
        
        $this->assertNotEmpty($this->usersGetter->getQueryBuilder()->getParameter('surname'));
    }
    
    public function testSetStatus()
    {
        $this->usersGetter->setStatus('active');
 
        $this->assertNotEmpty( $this->usersGetter->getQueryBuilder()->getParameter('status') );
    }
}

