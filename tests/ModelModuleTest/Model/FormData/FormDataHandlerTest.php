<?php

namespace ApplicationTest\Model\FormData;

use ModelModuleTest\TestSuite;
use ModelModule\Model\FormData\FormDataHandler;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class FormDataHandlerTest extends TestSuite
{
    /**
     * @var FormDataHandler
     */
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
    }
    
    public function testSetupRecord()
    {
        $this->formDataHandler = new FormDataHandler();
        $this->assertTrue( is_array($this->formDataHandler->setupRecord()) );

        $this->formDataHandler = new FormDataHandler(array(
           'formsetter' => 'MyFormSetterClassMap',
           'formdata_classmap' => 'MyFormDataClassMap')
        );
        $this->assertTrue( is_array($this->formDataHandler->setupRecord()) );
    }
}
