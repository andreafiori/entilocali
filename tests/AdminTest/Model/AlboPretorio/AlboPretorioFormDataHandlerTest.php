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
    private $alboPretorioFormDataHandlerer;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioFormDataHandlerer = new AlboPretorioFormDataHandler( $this->getFrontendCommonInput() );
    }
}
