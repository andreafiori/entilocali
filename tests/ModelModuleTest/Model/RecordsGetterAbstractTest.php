<?php

namespace ModelModuleTest\Model;

use ModelModuleTest\TestSuite;

class RecordsGetterAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\RecordsGetterAbstract
     */
    private $recordsGetterAbstract;
    
    private $recordSetSampleData;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetterAbstract = $this->getMockForAbstractClass(
            '\ModelModule\Model\RecordsGetterAbstract', array($this->getFrontendCommonInput())
        );
        
        $this->recordSetSampleData = array( array('id' => '1','name' => 'John'), array('id' => 2,'name' => 'Steve') );
    }

    public function testSetEntityManager()
    {
        $this->recordsGetterAbstract->setEntityManager($this->getEntityManagerMock());

        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $this->recordsGetterAbstract->getEntityManager());
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