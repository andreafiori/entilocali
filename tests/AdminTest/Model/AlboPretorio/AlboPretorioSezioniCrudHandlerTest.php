<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  26 October 2014
 */
class AlboPretorioSezioniCrudHandlerTest //extends TestSuite
{
    private $alboPretorioSezioniCrudHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioSezioniCrudHandler = new AlboPretorioSezioniCrudHandler($this->getFrontendCommonInput());
    }
    
    public function testInsert()
    {
        
    }
}