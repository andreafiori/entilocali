<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class RecordsGetterAbstractTest extends TestSuite
{
    private $recordsGetterAbstract;
    
    private $recordSetSampleData;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetterAbstract = $this->getMockForAbstractClass('Application\Model\RecordsGetterAbstract', array($this->getFrontendCommonInput()));
        
        $this->recordSetSampleData = array( array('id' => '1','name' => 'John'), array('id' => 2,'name' => 'Steve') );
    }
    
    public function testSetFirstRow()
    {
        $this->recordsGetterAbstract->setFirstRow();
        
        $this->assertEquals($this->recordsGetterAbstract->getFirstRow(), 1);
    }
    
    public function testReturnRecordsetReturnsFalse()
    {
        $this->assertFalse( $this->recordsGetterAbstract->returnRecordset() );
    }
    
    public function testReturnRecordsetReturnsSingleRecord()
    {
        $this->recordsGetterAbstract->setRecords($this->recordSetSampleData);
        $this->recordsGetterAbstract->setFirstRow();

        $this->assertArrayHasKey('id', $this->recordsGetterAbstract->returnRecordset());
    }
    
    public function testReturnRecordset()
    {
        $this->recordsGetterAbstract->setRecords($this->recordSetSampleData);
        
        $this->assertTrue( is_array($this->recordsGetterAbstract->returnRecordset()) );
        $this->assertTrue( count($this->recordsGetterAbstract->returnRecordset()) > 1 );
    }
    
    public function testSetRecords()
    {
        $this->recordsGetterAbstract->setRecords($this->recordSetSampleData);

        $this->assertEquals($this->recordsGetterAbstract->getRecords(), $this->recordSetSampleData);
    }
}