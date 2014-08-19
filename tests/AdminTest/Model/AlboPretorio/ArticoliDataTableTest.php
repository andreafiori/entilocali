<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\ArticoliDataTable;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class ArticoliDataTableTest extends TestSuite
{
    private $articoliDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->articoliDataTable = new ArticoliDataTable( $this->getFrontendCommonInput() );
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