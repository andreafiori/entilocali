<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioArticoliDataTable;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class AlboPretorioArticoliDataTableTest extends TestSuite
{
    private $articoliDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->articoliDataTable = new AlboPretorioArticoliDataTable( $this->getFrontendCommonInput() );
    }
    
    public function testGetTitle()
    {
        $this->assertNotEmpty( $this->articoliDataTable->getTitle() );
    }
    
    public function testGetDescription()
    {
        $this->assertNotEmpty( $this->articoliDataTable->getDescription() );
    }
}