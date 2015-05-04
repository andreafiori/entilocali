<?php

namespace AdminTest\Controller\Users;

use Admin\Controller\Users\UsersFormController;
use ApplicationTest\TestSuite;

class UsersFormControllerTest //extends TestSuite
{
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}