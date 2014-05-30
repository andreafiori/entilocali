<?php

namespace ApplicationTest\Model\FormData;

use ApplicationTest\TestSuite;
use Admin\Model\FormData\FormDataHandler;

/**
 * @author Andrea Fiori
 * @since  19 May 2014
 */
class FormDataHandlerTest extends TestSuite
{
    private $formDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
    }
    
    public function testSetupRecord()
    {
       $this->formDataHandler = new FormDataHandler();
       $this->assertTrue( is_array($this->formDataHandler->setupRecord()) );
       
       $input = array('formsetter' => 'MyFormSetterClassMap', 'formdata_classmap' => 'MyFormDataClassMap');
       $this->formDataHandler = new FormDataHandler($input);
       $this->assertTrue( is_array($this->formDataHandler->setupRecord()) );
    }
}
