<?php

namespace ApplicationTest\Controller;

use ApplicationTest\TestSuite;
use Admin\Controller\AuthController;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class AuthControllerTest extends TestSuite
{
    private $controller;

    protected function setUp()
    {
        parent::setUp();
        
        $this->controller = new AuthController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }
    
    public function testShowFormLoginAction()
    {
        $this->routeMatch->setParam('action', 'showFormLogin');
        
        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
