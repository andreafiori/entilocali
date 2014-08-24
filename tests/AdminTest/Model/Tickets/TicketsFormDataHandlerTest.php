<?php

namespace ApplicationTest\Model\Tickets;

use Admin\Model\Tickets\TicketsFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  21 August 2014
 */
class TicketsFormDataHandlerTest //extends TestSuite
{
    private $ticketsFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new TicketsFormDataHandler();
    }
}
