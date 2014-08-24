<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\ApiResourceHandler;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiResourceHandlerTest extends TestSuite
{
    private $apiResourceHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiResourceHandler = new ApiResourceHandler();
    }
    
    public function testSetResourceClassName()
    {
        $this->apiResourceHandler->setResourceClassName('contents');
        
        $this->assertNotEmpty($this->apiResourceHandler->getResourceClassName());
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetInvalidResource()
    {
        $this->apiResourceHandler->setResourceClassName('invalid-resource');
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetInvalidResourceWithNonExistentClass()
    {
        $this->apiResourceHandler->setResourceClassMap( array('content' => 'ClassDoesntExist') );
        
        $this->apiResourceHandler->setResourceClassName('content');
    }
}