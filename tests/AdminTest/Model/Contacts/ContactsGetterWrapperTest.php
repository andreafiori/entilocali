<?php

namespace AdminTest\Model\Contacts;

use ApplicationTest\TestSuite;
use Admin\Model\Contacts\ContactsGetter;
use Admin\Model\Contacts\ContactsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContactsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ContactsGetterWrapper( new ContactsGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
