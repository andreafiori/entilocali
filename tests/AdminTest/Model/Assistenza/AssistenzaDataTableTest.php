<?php

namespace ApplicationTest\Model\Assistenza;

use ApplicationTest\TestSuite;
use Admin\Model\Assistenza\AssistenzaDataTable;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class AssistenzaDataTableTest extends TestSuite
{
    private $assistenzaDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->assistenzaDataTable = new AssistenzaDataTable( $this->getFrontendCommonInput() );   
    }
    
    public function testGetTitle()
    {
        $this->assertNotEmpty( $this->assistenzaDataTable->getTitle() );
    }
    
    public function testGetDescription()
    {
        $this->assertNotEmpty( $this->assistenzaDataTable->getDescription() );
    }
    
    public function testGetColumns()
    {
        $this->assertTrue(is_array($this->assistenzaDataTable->getColumns()) );
    }
    
    public function testGetRecords()
    {
        $this->assertTrue(is_array($this->assistenzaDataTable->getRecords()) );
    }
}
