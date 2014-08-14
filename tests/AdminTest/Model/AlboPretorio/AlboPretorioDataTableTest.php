<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioDataTable;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class AlboPretorioDataTableTest extends TestSuite
{
    private $alboPretorioDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioDataTable = new AlboPretorioDataTable( $this->getFrontendCommonInput() );
    }
    
    public function testGetTitle()
    {
        $this->assertNotEmpty( $this->alboPretorioDataTable->getTitle() );
    }
    
    public function testGetDescription()
    {
        $this->assertNotEmpty( $this->alboPretorioDataTable->getDescription() );
    }
}