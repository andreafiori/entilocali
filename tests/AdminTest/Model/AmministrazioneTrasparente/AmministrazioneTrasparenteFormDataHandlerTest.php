<?php

namespace AdminTest\Model\AmministrazioneTrasparente;

use ApplicationTest\TestSuite;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AmministrazioneTrasparenteFormDataHandlerTest extends TestSuite
{
    private $amministrazioneTrasparenteFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->amministrazioneTrasparenteFormDataHandler = new AmministrazioneTrasparenteFormDataHandler($this->getFrontendCommonInput());
    }
    
    public function testFormProperties()
    {
        $this->assertNotEmpty( $this->amministrazioneTrasparenteFormDataHandler->getVarToExport('title') );
        $this->assertNotEmpty( $this->amministrazioneTrasparenteFormDataHandler->getVarToExport('description') );
        $this->assertInstanceOf('\Zend\Form\Form', $this->amministrazioneTrasparenteFormDataHandler->getVarToExport('form') );
    }
}
