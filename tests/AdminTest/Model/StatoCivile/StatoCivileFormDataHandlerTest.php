<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandlerTest // extends TestSuite
{
    /**
     * @var StatoCivileFormDataHandler
     */
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new StatoCivileFormDataHandler( $this->getFrontendCommonInput() );
    }

    public function testFormVars()
    {
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('form') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formAction') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formTitle') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formDescription') );
    }
}