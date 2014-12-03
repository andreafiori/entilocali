<?php

namespace AdminTest\Service;

use ApplicationTest\TestSuite;
use stdClass;

/**
 * @author Andrea Fiori
 * @since  26 November 2014
 */
class AppServiceLoaderAbstractTest extends TestSuite
{
    private $appServiceLoaderAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->appServiceLoaderAbstract = $this->getMockForAbstractClass('\Admin\Service\AppServiceLoaderAbstract', array() );
    }
    
    public function testSetService()
    {
        $this->appServiceLoaderAbstract->setService('myService', new stdClass() );
        
        $this->assertInstanceOf('\stdClass', $this->appServiceLoaderAbstract->recoverService('myService'));
    }
    
    public function testRecoverServiceKey()
    {
        $this->appServiceLoaderAbstract->setService('myService', array('key_1'=> 'a string', 'key_2'=>'another string') );
        
        $this->assertEquals('a string', $this->appServiceLoaderAbstract->recoverServiceKey('myService', 'key_1'));
    }
    
    public function testGetProperties()
    {
        $this->appServiceLoaderAbstract->setService('myService', array('key_1'=> 'a string', 'key_2'=>'another string'));
        
        $this->assertNotEmpty( $this->appServiceLoaderAbstract->getProperties() );
    }
    
    public function testGetController()
    {
        $this->appServiceLoaderAbstract->setController(new \Admin\Controller\AdminController());

        $this->assertTrue(is_object($this->appServiceLoaderAbstract->getController()) );
    }
}