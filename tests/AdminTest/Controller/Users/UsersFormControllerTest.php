<?php

namespace AdminTest\Controller\Users;

use Admin\Controller\Users\UsersFormController;
use ModelModuleTest\TestSuite;

class UsersFormControllerTest extends TestSuite
{
    /**
     * @var UsersFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->setupUserSession($this->recoverUserDetails());

        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}