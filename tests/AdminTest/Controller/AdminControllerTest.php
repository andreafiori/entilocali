<?php

namespace AdminTest\Controller;

use Admin\Controller\AdminController;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class AdminControllerTest // extends TestSuite
{
    private $controller;

    protected function setUp()
    {
        parent::setUp();
        
        $this->controller = new AdminController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionCannotBeAccessedWithoutLogin()
    {
        $this->routeMatch->setParam('action', 'index');
        
        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionCanAccessedAfterAuthentication()
    {
        $this->routeMatch->setParam('action', 'index');
 
        $this->controller->getServiceLocator()->setAllowOverride(true);
        
        $this->getServiceManager()->setService('AuthService', $this->getAuthserviceMock());
        $this->getServiceManager()->setService('Request', new \Zend\Http\PhpEnvironment\Request() );
 
        $this->controller->setServiceLocator($this->getServiceManager());
        
        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

        /**
         * AuthService mock identity
         * 
         * @return \Zend\Authentication\AuthenticationService
         */
        private function getAuthserviceMock()
        {
            $authService = $this->getMock('Zend\Authentication\AuthenticationService');
            $authService->expects($this->any())
                        ->method('getIdentity')
                        ->will($this->returnValue(new \stdClass));

            $authService->expects($this->any())
                        ->method('hasIdentity')
                        ->will($this->returnValue(true));
            
            return $authService;
        }
}