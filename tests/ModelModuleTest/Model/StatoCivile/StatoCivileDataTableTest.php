<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileDataTable;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileDataTableTest //extends TestSuite
{
    private $statoCivileDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->statoCivileDataTable = new StatoCivileDataTable($this->getFrontendCommonInput());
    }
    
    public function testGetColumns()
    {
        $this->assertTrue( is_array($this->statoCivileDataTable->getColumns()) );
    }
    
    public function testGetRecords()
    {
        $this->assertTrue( is_array($this->statoCivileDataTable->getRecords()) );
    }
}
