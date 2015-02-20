<?php

namespace ApplicationTest\Model\Tickets;

use ApplicationTest\TestSuite;
use Admin\Model\Tickets\TicketsFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  21 August 2014
 */
class TicketsFormDataHandlerTest extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new TicketsFormDataHandler( $this->getFrontendCommonInput() );
    }

    public function testFormVars()
    {
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('form') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formAction') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formTitle') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formDescription') );
    }
}
