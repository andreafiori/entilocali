<?php

namespace AdminTest\Controller\Users\Roles;

use Admin\Controller\Users\Roles\UsersRolesFormController;
use ModelModuleTest\TestSuite;

class UsersRolesFormControllerTest extends TestSuite
{
    /**
     * @var UsersRolesFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersRolesFormController();
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
