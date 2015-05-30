<?php

namespace ModelModuleTest\Model;

use ModelModuleTest\TestSuite;

class InputSetterGetterAbstract extends TestSuite
{
    /**
     * @var \ModelModule\Model\InputSetterGetterAbstract
     */
    private $inpuSetupAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->inpuSetupAbstract = $this->getMockForAbstractClass('\ModelModule\Model\InputSetterGetterAbstract');
    }
    
    public function testGetInput()
    {
        $this->assertEmpty( $this->inpuSetupAbstract->getInput('ThisIsAFakeInputParameter') );
    }
}
