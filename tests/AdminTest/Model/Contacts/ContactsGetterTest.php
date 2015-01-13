<?php

namespace AdminTest\Model\Contacts;

use ApplicationTest\TestSuite;
use Admin\Model\Contacts\ContactsGetter;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class ContactsGetterTest extends TestSuite
{
    /**
     * @var ContactsGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new ContactsGetter( $this->getEntityManagerMock() );
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
    
    public function testSetEmail()
    {
        $this->objectGetter->setEmail('john@doe.com');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('email'));
    }
    
    public function testSurname()
    {
        $this->objectGetter->setSurname('Doe');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('surname'));
    }
}