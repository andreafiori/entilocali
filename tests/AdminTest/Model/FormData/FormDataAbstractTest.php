<?php

namespace AdminTest\Model\FormData;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class FormDataAbstractTest extends TestSuite
{
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
    
}