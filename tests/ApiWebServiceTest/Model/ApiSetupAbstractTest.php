<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
class ApiSetupAbstractTest extends TestSuite
{
    private $apiSetupAbstract;
    private $validInputSample;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiSetupAbstract = $this->getMockForAbstractClass('ApiWebService\Model\ApiSetupAbstract');
        
        $this->validInputSample = array(
            'key'       => 'myApiKey',
            'username'  => 'myUsername',
            'password'  => 'myPassword'
        );
    }
    
    public function testSetMethod()
    {
        $this->assertEquals($this->apiSetupAbstract->setMethod('GET'), 'GET');
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetUnvalidMethod()
    {
        $this->apiSetupAbstract->setMethod('UNLINK');
        
        $this->assertInstanceOf('\Zend\Http\Response', $this->apiSetupAbstract->getResponseToReturn());
    }
    
    public function testSetInput()
    {
        $this->apiSetupAbstract->setInput($this->validInputSample);
        
        $this->assertTrue( is_array($this->apiSetupAbstract->getInput()) );
        $this->assertEquals($this->apiSetupAbstract->getInput('username'), 'myUsername');
    }
    
    public function testGetResponseToReturnIsEmpty()
    {
        $this->assertEmpty( $this->apiSetupAbstract->getResponseToReturn() );
    }
}