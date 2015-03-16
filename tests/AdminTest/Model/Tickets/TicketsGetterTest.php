<?php

namespace ApplicationTest\Model\Tickets;

use ApplicationTest\TestSuite;
use Admin\Model\Tickets\TicketsGetter;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class TicketsGetterTest extends TestSuite
{
    /**
     * @var TicketsGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new TicketsGetter( $this->getEntityManagerMock() );
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
    
}
