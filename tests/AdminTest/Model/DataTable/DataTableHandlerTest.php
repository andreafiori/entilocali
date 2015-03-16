<?php

namespace AdminTest\Model\DataTable;

use ApplicationTest\TestSuite;
use Admin\Model\DataTable\DataTableHandler;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
class DataTableHandlerTest extends TestSuite
{
    /**
     * @var DataTableHandler
     */
    private $dataTableHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->dataTableHandler = new DataTableHandler( $this->getFrontendCommonInput() );
    }
 
    public function testSetupRecord()
    {
        $this->assertTrue( is_array($this->dataTableHandler->setupRecord()) );
    }
}
