<?php

namespace ModelModuleTest\Model\Contacts;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Contacts\ContactsGetter;
use ModelModule\Model\Contacts\ContactsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContactsGetterWrapperTest extends TestSuite
{
    /**
     * @var ContactsGetterWrapper
     */
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
