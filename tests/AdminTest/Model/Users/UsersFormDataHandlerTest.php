<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\UsersFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
class UsersFormDataHandlerTest extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new UsersFormDataHandler( $this->getFrontendCommonInput() );
    }

    public function testFormVars()
    {
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('form') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formAction') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formTitle') );
        $this->assertNotEmpty( $this->formDataHandler->getVarToExport('formDescription') );
    }
}