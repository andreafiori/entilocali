<?php

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler;

class AlboPretorioSezioniFormDataHandlerTest //extends TestSuite
{
    private $alboPretorioSezioniFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioFormDataHandlere = new AlboPretorioSezioniFormDataHandler( $this->getFrontendCommonInput() );
    }
}
