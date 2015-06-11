<?php

namespace AdminTest\Controller\Users\RespProc;

use Admin\Controller\Users\RespProc\UsersRespProcController;
use ModelModuleTest\TestSuite;

class UsersRespProcControllerTest extends TestSuite
{
    /**
     * @var UsersRespProcController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersRespProcController();
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
