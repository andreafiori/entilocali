<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\ApiOutputManager;

/**
 * @author Andrea Fiori
 * @since  16 September 2014
 */
class ApiOutputManagerTest extends TestSuite
{
    private $apiOutputManager;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiOutputManager = new ApiOutputManager('json');
    }
    
    public function testGetOutputFormat()
    {
        $this->assertEquals($this->apiOutputManager->getOutputFormat(), 'json');
    }
    
    public function testSetupJSONOutput()
    {
        $this->assertInstanceOf('\Zend\View\Model\JsonModel', $this->apiOutputManager->setupOutput( array('content'=>array('mycnt'=>'myvalue'))) );
    }
    
    public function testSetupXMLOutput()
    {
        $this->apiOutputManager = new ApiOutputManager('xml');
        
        $this->assertInstanceOf('\Zend\Http\Response', $this->apiOutputManager->setupOutput( array('content'=>array('mycnt'=>'myvalue'))) );
    }
}