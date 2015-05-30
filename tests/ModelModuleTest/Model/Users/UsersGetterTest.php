<?php

namespace ModelModuleTest\Model\Users;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\UsersGetter;

/**
 * @author Andrea Fiori
 * @since  16 June 2014
 */
class UsersGetterTest extends TestSuite
{
    /**
     * @var UsersGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new UsersGetter($this->getEntityManagerMock());
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->objectGetter->setId(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetSurname()
    {
        $this->objectGetter->setSurname('Doe');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('surname'));
    }

    public function testSetEmail()
    {
        $this->objectGetter->setEmail('john@doe.com');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('email'));
    }

    public function testSetUsername()
    {
        $this->objectGetter->setUsername('MyUsername');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('username'));
    }

    public function testPassword()
    {
        $this->objectGetter->setPassword('MyEasyPassword');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('password'));
    }

    public function testSalt()
    {
        $this->objectGetter->setSalt('SaltString');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('salt'));
    }

    public function testSetStatus()
    {
        $this->objectGetter->setStatus('active');
 
        $this->assertNotEmpty( $this->objectGetter->getQueryBuilder()->getParameter('status') );
    }
}
