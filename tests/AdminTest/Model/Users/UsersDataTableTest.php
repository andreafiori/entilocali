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
    private $usersDataTable;
    
    protected function setUp()
    {    
        parent::setUp();
        
        $this->usersDataTable = new UsersDataTable( $this->getFrontendCommonInput() );
    }
    
    public function testGetColumns()
    {
        $this->assertTrue( is_array($this->usersDataTable->getColumns()) );
    }
    
    public function testGetRecords()
    {
        $this->assertTrue( is_array($this->usersDataTable->getRecords()) );
    }
}