<?php

namespace ApplicationTest\Model\Tickets;

use ApplicationTest\TestSuite;
use Admin\Model\Tickets\TicketsDataTable;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class TicketsDataTableTest extends TestSuite
{
    private $ticketingDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->ticketingDataTable = new TicketsDataTable( $this->getFrontendCommonInput() );
    }
    
    public function testGetTitle()
    {
        $this->assertNotEmpty( $this->ticketingDataTable->getTitle() );
    }
    
    public function testGetDescription()
    {
        $this->assertNotEmpty( $this->ticketingDataTable->getDescription() );
    }
    
    public function testGetColumns()
    {
        $this->assertTrue(is_array($this->ticketingDataTable->getColumns()) );
    }
    
    public function testGetRecords()
    {
        $this->assertTrue(is_array($this->ticketingDataTable->getRecords()) );
    }
}
