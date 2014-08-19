<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  11 June 2014
 */
class RecordsGetterWrapperAbstractTest extends TestSuite
{
    private $recordsGetterWrapperAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetterWrapperAbstract = $this->getMockForAbstractClass('\Application\Model\RecordsGetterWrapperAbstract');
    }
    
    public function testSetInput()
    {
        $this->assertTrue( is_array($this->recordsGetterWrapperAbstract->setInput($this->getFrontendCommonInput())) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testGetRecordsThrowsException()
    {
        $this->recordsGetterWrapperAbstract->getRecords();
    }
}
