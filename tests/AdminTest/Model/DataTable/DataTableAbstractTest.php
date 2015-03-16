<?php

namespace ApplicationTest\Model\FormData;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class DataTableAbstractTest extends TestSuite
{
    /**
     * @var \Admin\Model\DataTable\DataTableAbstract
     */
    private $dataTableAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->dataTableAbstract = $this->getMockForAbstractClass('Admin\Model\DataTable\DataTableAbstract', array( $this->getFrontendCommonInput() ) );
    }
    
    public function testSetParam()
    {
        $this->dataTableAbstract->setParam( array('id'=>1,'myKey'=>'4asdklj4232d', 'arr2' => array('key2'=>'value')) );
        
        $this->assertArrayHasKey('id', $this->dataTableAbstract->getParam() );
        $this->assertEquals($this->dataTableAbstract->getParam('id'), 1);
        $this->assertEquals($this->dataTableAbstract->getParam('arr2','key2'), 'value');
    }
    
    public function testGetTemplate()
    {
        $this->assertNotEmpty( $this->dataTableAbstract->getTemplate() );
        
        $this->dataTableAbstract->setRecords( array('id' => 1, 'myRecord' => 'myRecordValue') );
        
        $this->assertNotEmpty( $this->dataTableAbstract->getTemplate() );
    }
}
