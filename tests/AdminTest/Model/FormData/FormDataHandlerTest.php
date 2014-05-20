<?php

namespace ApplicationTest\Model\FormData;

use ApplicationTest\TestSuite;
use Admin\Model\FormData\FormDataHandler;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class FormDataHandlerTest extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new FormDataHandler();
    }
    
    public function testSetupRecord()
    {
       $this->assertTrue( is_array($this->formDataHandler->setupRecord()) );
    }
}
