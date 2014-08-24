<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\ApiInputSetterGetter;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiInputSetterGetterTest extends TestSuite
{
    private $apiInputSetterGetter;
    private $validInputSample;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiInputSetterGetter = new ApiInputSetterGetter();
        
        $this->validInputSample = array(
            'key'       => 'myApiKey',
            'username'  => 'myUsername',
            'password'  => 'myPassword'
        );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupAuthenticationInputThrowsException()
    {
        $this->apiInputSetterGetter->setupAuthenticationInput();
        
        $this->assertInstanceOf('\Zend\Http\Response', $this->apiInputSetterGetter->getResponseToReturn());
    }
    
    public function testSetupAuthenticationInput()
    {
        $this->apiInputSetterGetter->setInput($this->validInputSample);
        
        $this->apiInputSetterGetter->setupAuthenticationInput();
        
        $this->assertTrue( is_array($this->apiInputSetterGetter->getAuthenticationInput()) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testValidateAuthenticationInputThrowsException()
    {
        $this->apiInputSetterGetter->setInput(array('unuselessKey'=>'noGoValue'));
        
        $this->apiInputSetterGetter->setupAuthenticationInput();
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testValidateAuthenticationInputThrowsSecondException()
    {
        $this->apiInputSetterGetter->setInput(array('username' => 'myUsername'));
        
        $this->apiInputSetterGetter->setupAuthenticationInput();
    }
}
