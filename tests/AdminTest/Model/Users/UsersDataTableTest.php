<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\UsersDataTable;

/**
 * @author Andrea Fiori
 * @since  15 June 2014
 */
class UsersDataTableTest extends TestSuite
{
    private $dataTableObject;
    
    protected function setUp()
    {    
        parent::setUp();
        
        $this->dataTableObject = new UsersDataTable( $this->getFrontendCommonInput() );
    }

    public function testGetTitle()
    {
        $this->assertNotEmpty( $this->dataTableObject->getTitle() );
    }

    public function testGetDescription()
    {
        $this->assertNotEmpty( $this->dataTableObject->getDescription() );
    }

    public function testGetRecords()
    {
        $this->assertTrue( is_array($this->dataTableObject->getRecords()) );
    }
}