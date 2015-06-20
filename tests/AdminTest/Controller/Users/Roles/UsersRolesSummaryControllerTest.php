<?php

namespace AdminTest\Controller\Users\Roles;

use Admin\Controller\Users\Roles\UsersRolesSummaryController;
use ModelModuleTest\TestSuite;

class UsersRolesSummaryControllerTest extends TestSuite
{
    /**
     * @var UsersRolesSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersRolesSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->setupUserSession($this->recoverUserDetails());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
