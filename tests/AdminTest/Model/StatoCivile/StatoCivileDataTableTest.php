<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileDataTable;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileDataTableTest extends TestSuite
{
    private $statoCivileDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->statoCivileDataTable = new StatoCivileDataTable($this->getFrontendCommonInput());
    }
    
    public function testGetColumns()
    {
        $this->assertTrue(is_array($this->statoCivileDataTable->getColumns()) );
    }
}
