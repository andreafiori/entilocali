<?php

namespace AdminTest\Model\FormData;

use ApplicationTest\TestSuite;
use Admin\Model\FormData\FormDataCrudHandler;

/**
 * @author Andrea Fiori
 * @since  30 May 2014
 */
class FormDataCrudHandlerTest extends TestSuite
{
    /**
     * @var FormDataCrudHandler
     */
    private $formDataCrudHandler;

    private $classMapTest;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->formDataCrudHandler = new FormDataCrudHandler( $this->getFrontendCommonInput() );
        
        $this->classMapTest = array('posts' => 'Admin\Posts\PostsCrudHandler');
    }
    
    public function testSetFormCrudHandler()
    {
        $this->assertEquals($this->formDataCrudHandler->setFormCrudHandler('posts'), 'posts');
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testDetectCrudHandlerClassMapFormCrudHandlerNotSetException()
    {        
        $this->formDataCrudHandler->detectCrudHandlerClassMap($this->classMapTest);
    }

    public function testDetectCrudHandlerClassMap()
    {
        $this->formDataCrudHandler->setFormCrudHandler('posts');
        
        $this->assertTrue(is_string($this->formDataCrudHandler->detectCrudHandlerClassMap($this->classMapTest)) );
    }
}
