<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  16 August 2014
 */
class AlboPretorioFormDataHandlerTest //extends TestSuite
{
    private $alboPretorioFormDataHandlere;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioFormDataHandlere = new AlboPretorioFormDataHandler( $this->getFrontendCommonInput() );
    }
}