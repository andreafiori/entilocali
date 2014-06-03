<?php

namespace AdminTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class InputSetupTemplateAbstractTest extends TestSuite
{
    private $inputSetupTemplateAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->inputSetupTemplateAbstract = $this->getMockForAbstractClass('Admin\Model\InputSetupTemplateAbstract', array( $this->getFrontendCommonInput() ) );
    }
    
    public function testSetTemplate()
    {
        $this->assertEquals($this->inputSetupTemplateAbstract->setTemplate('myTemplate.phtml'), $this->inputSetupTemplateAbstract->getTemplate());
    }
}