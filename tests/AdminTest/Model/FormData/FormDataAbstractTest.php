<?php

namespace AdminTest\Model\FormData;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class FormDataAbstractTest extends TestSuite
{
    /**
     * @var \Admin\Model\FormData\FormDataAbstract
     */
    private $formDataAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataAbstract = $this->getMockForAbstractClass('\Admin\Model\FormData\FormDataAbstract', array($this->getFrontendCommonInput()) );
    }
    
    public function testSetVariable()
    {
        $this->assertEmpty( $this->formDataAbstract->getVarToExport() );
        
        $this->formDataAbstract->setVariable('myKey', 'myValue');
        
        $this->assertEquals($this->formDataAbstract->getVarToExport('myKey'), 'myValue');
    }
    
    public function testSetRecord()
    {
        $this->formDataAbstract->setRecord(array(array('id'=>1,'title'=>'myTitle')));
        
        $this->assertTrue( is_array($this->formDataAbstract->getRecord()) );
    }
    
    public function testGetProperty()
    {
        $this->assertNotEmpty($this->formDataAbstract->getProperty('template'));
    }
}