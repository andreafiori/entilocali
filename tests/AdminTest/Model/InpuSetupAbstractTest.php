<?php

namespace AdminTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
class InpuSetupAbstractTest extends TestSuite
{
    private $inpuSetupAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->inpuSetupAbstract = $this->getMockForAbstractClass('Admin\Model\InputSetupAbstract', array($this->getFrontendCommonInput()) );
    }
    
    public function testGetInput()
    {
        $this->assertNotEmpty( $this->inpuSetupAbstract->getInput('request') );
    }
    
    public function testDefaultInput()
    {
        $this->assertTrue( is_array($this->inpuSetupAbstract->getInput()) );
    }
    
    public function testSetTemplate()
    {
        $this->assertEquals($this->inpuSetupAbstract->setTemplate('myTemplate.phtml'), $this->inpuSetupAbstract->getTemplate());
    }
}
