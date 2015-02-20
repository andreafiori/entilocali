<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  16 August 2014
 */
class AlboPretorioFormDataHandlerTest // extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new AlboPretorioFormDataHandler( $this->getFrontendCommonInput() );
    }

    public function testFormVars()
    {
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('form') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formAction') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formTitle') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formDescription') );
    }
}
