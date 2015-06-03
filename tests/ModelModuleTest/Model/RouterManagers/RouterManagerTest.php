<?php

namespace ModelModuleTest\Model\RouterManagers;

use ModelModuleTest\TestSuite;
use ModelModule\Model\RouterManagers\RouterManager;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class FrontendRouterTest extends TestSuite
{
    private $routerManager;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->routerManager = new RouterManager( array(
            "sitename"          => "MySite",
            "routeMatchName"    => "default",
        ));
    }
    
    public function testSetIsBackend()
    {
        $this->routerManager->setIsBackend();
        $this->assertEmpty( $this->routerManager->isBackend() );
        
        $this->routerManager->setIsBackend(1);
        $this->assertEquals($this->routerManager->isBackend(), 1);
    }
    
    public function testSetRouteMatchName()
    {
        $route = $this->routerManager->setRouteMatchName(array(
            "default" => 'Application\Model\Posts\PostsFrontend',
            "admin" => 'Application\Model\Posts\PostsFrontend',
        ));
        
        $this->assertNotNull($route);
    }
}