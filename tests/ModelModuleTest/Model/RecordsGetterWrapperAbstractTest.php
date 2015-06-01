<?php

namespace ModelModuleTest\Model;

use ModelModuleTest\TestSuite;

class RecordsGetterWrapperAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\RecordsGetterWrapperAbstract
     */
    private $recordsGetterWrapperAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetterWrapperAbstract = $this->getMockForAbstractClass(
            '\ModelModule\Model\RecordsGetterWrapperAbstract'
        );
    }
    
    public function testSetInput()
    {
        $this->assertTrue( is_array($this->recordsGetterWrapperAbstract->setInput($this->getFrontendCommonInput())) );
    }
    
    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testGetRecordsThrowsException()
    {
        $this->recordsGetterWrapperAbstract->getRecords();
    }
}
