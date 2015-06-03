<?php

namespace ModelModuleTest\Service;

use ModelModuleTest\TestSuite;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;

class AppServiceLoaderAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Service\AppServiceLoaderAbstract
     */
    private $appServiceLoaderAbstract;

    private $arraySample;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->appServiceLoaderAbstract = $this->getMockForAbstractClass('\ModelModule\Service\AppServiceLoaderAbstract', array() );

        $this->arraySample = array(
            'key_1' => 'a string',
            'key_2' => 'another string'
        );
    }
    
    public function testSetService()
    {
        $this->appServiceLoaderAbstract->setService('myService', new \stdClass() );
        
        $this->assertInstanceOf('\stdClass', $this->appServiceLoaderAbstract->recoverService('myService'));
    }
    
    public function testRecoverServiceKey()
    {
        $this->appServiceLoaderAbstract->setService('myService', $this->arraySample);
        
        $this->assertEquals('a string', $this->appServiceLoaderAbstract->recoverServiceKey('myService', 'key_1'));
    }

    public function testRecoverServiceKeyReturnsNull()
    {
        $this->assertNull( $this->appServiceLoaderAbstract->recoverServiceKey('myKey', 'myString'));
    }
    
    public function testGetProperties()
    {
        $this->appServiceLoaderAbstract->setService('myService', $this->arraySample);
        
        $this->assertNotEmpty( $this->appServiceLoaderAbstract->getProperties() );
    }

    public function testSetProperties()
    {
        $this->assertNull($this->appServiceLoaderAbstract->getProperties());

        $this->appServiceLoaderAbstract->setProperties($this->arraySample);

        $this->assertEquals($this->appServiceLoaderAbstract->getProperties(), $this->arraySample);
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testRecoverRouterThrowsNullException()
    {
        $this->appServiceLoaderAbstract->recoverRouter();
    }

    public function testRecoverRouter()
    {
        $this->appServiceLoaderAbstract->setService('serviceManager', $this->serviceManager);

        $router = $this->appServiceLoaderAbstract->recoverRouter();

        $this->assertTrue( (get_class($router) == 'Zend\Mvc\Router\Console\SimpleRouteStack'
            or get_class($router) == 'Zend\Mvc\Router\Http\TreeRouteStack') );
    }
    
    public function testGetController()
    {
        $this->appServiceLoaderAbstract->setController(new \Admin\Controller\AdminController());

        $this->assertTrue(is_object($this->appServiceLoaderAbstract->getController()) );
    }
}
