<?php

namespace AdminTest\Service;

use Admin\Service\AppServiceLoader;
use Admin\Controller\AdminController;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;
use Application\Setup\UserInterfaceConfigurations;
use ApplicationTest\TestSuite;

class AppServiceLoaderTest extends TestSuite
{
    /**
     * @var AppServiceLoader
     */
    private $appServiceLoader;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->appServiceLoader = new AppServiceLoader( array() );
    }
    
    public function testSetupUri()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupUri();
        
        $this->assertNull($this->appServiceLoader->recoverService('uri'));
    }
    
    public function testSetupRedirect()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupRedirect();
        
        $this->assertNotEmpty($this->appServiceLoader->recoverService('redirect'));
    }
    
    public function testSetupFleshMessenger()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupFlashMessenger();
        
        $this->assertTrue(is_object($this->appServiceLoader->recoverService('flashMessenger')));
    }
    
    public function testSetupCurrentModuleName()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupCurrentModuleName();
        
        $this->assertNotEmpty($this->appServiceLoader->recoverService('module'));
    }
    
    public function testSetupIsBackend()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupCurrentModuleName();
        $this->appServiceLoader->setupIsBackend();
        
        $this->assertNull( $this->appServiceLoader->recoverService('isBackend') );
    }
    
    public function testSetupIsBackendIsFalse()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupCurrentModuleName();
        $this->appServiceLoader->setupIsBackend('Application\Controller\Index');
        
        $this->assertFalse( $this->appServiceLoader->recoverService('isBackend') );
    }

    public function testSetupIsBackendIsTrue()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupCurrentModuleName();
        $this->appServiceLoader->setupIsBackend('Admin\Controller\Admin');
        
        $this->assertTrue( $this->appServiceLoader->recoverService('isBackend') );
    }
    
    public function testSetupParam()
    {
        $this->setupController();
        
        $this->appServiceLoader->setupParams();
        
        $this->assertTrue(is_array($this->appServiceLoader->recoverService('param')) );
    }
    
    public function testSetupConfigurations()
    {
        $this->setupController($this->routeMatch);
        
        $this->appServiceLoader->setupConfigurations(
            new ConfigGetterWrapper(new ConfigGetter($this->getEntityManagerMock())),
            array()
        );
        
        $this->assertTrue(is_array($this->appServiceLoader->recoverService('configurations')) );
    }

    public function testUserInterfaceConfigurations()
    {
        $this->setupController($this->routeMatch);

        $this->appServiceLoader->setupConfigurations(
            new ConfigGetterWrapper(new ConfigGetter($this->getEntityManagerMock())),
            array()
        );
        
        $ui = new UserInterfaceConfigurations($this->appServiceLoader->recoverService('configurations'));
        
        $this->assertInstanceOf('\Application\Setup\UserInterfaceConfigurations', $ui);
    }
    
        /**
         * Router and routeMatch are set here
         * 
         * @param RouteMatch|null $routeMatch
         */
        private function setupController($routeMatch = '')
        {
            $this->appServiceLoader->setController( new AdminController() );
            $this->appServiceLoader->getController()->setEvent($this->event);
            $this->appServiceLoader->getController()->setServiceLocator($this->getServiceManager());

            $this->appServiceLoader->setService('request', $this->getServiceManager()->get('request'));
            $this->appServiceLoader->setService('router', $this->router);
            $this->appServiceLoader->setService('routeMatch', $routeMatch);
        }
}