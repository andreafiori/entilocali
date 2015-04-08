<?php

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class AlboPretorioSezioniFormDataHandlerTest //extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataHandler = new AlboPretorioSezioniFormDataHandler( $this->getFrontendCommonInput() );
    }
    
    public function testGetSezione()
    {
        $this->assertEquals($this->formDataHandler->getSezione(new AlboPretorioRecordsGetter($this->getFrontendCommonInput()), 1), 1);
    }   
}
