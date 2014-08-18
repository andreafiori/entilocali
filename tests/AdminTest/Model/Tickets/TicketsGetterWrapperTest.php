<?php

use ApplicationTest\TestSuite;
use Admin\Model\Tickets\TicketsGetter;
use Admin\Model\Tickets\TicketsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class TicketsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new TicketsGetterWrapper( new TicketsGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
    
    
}