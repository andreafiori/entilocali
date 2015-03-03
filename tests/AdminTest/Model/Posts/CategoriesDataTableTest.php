<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\CategoriesDataTable;

/**
 * @author Andrea Fiori
 * @since  16 June 2014
 */
class CategoriesDataTableTest extends TestSuite
{
    private $categoriesDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->categoriesDataTable = new CategoriesDataTable($this->getFrontendCommonInput());
    }
    
    public function testGetColumns()
    {
        $this->assertTrue( is_array($this->categoriesDataTable->getColumns()) );
    }
}
