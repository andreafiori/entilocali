<?php

namespace AdminTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
class InputSetterGetterAbstract extends TestSuite
{
    private $inpuSetupAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->inpuSetupAbstract = $this->getMockForAbstractClass('Admin\Model\InputSetterGetterAbstract', array($this->getFrontendCommonInput()) );
    }
    
    public function testGetInput()
    {
        $this->assertNotEmpty( $this->inpuSetupAbstract->getInput('request') );
    }
    
    public function testInputWithoutArgument()
    {
        $this->assertTrue( is_array($this->inpuSetupAbstract->getInput()) );
    }
}
