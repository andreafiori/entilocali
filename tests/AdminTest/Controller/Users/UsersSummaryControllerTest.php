<?php

namespace AdminTest\Controller\Users;

use Admin\Controller\Users\UsersSummaryController;
use ModelModuleTest\TestSuite;

class UsersSummaryControllerTest extends TestSuite
{
    /**
     * @var UsersSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersSummaryController();
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