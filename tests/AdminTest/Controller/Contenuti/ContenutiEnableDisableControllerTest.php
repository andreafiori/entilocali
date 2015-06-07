<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiEnableDisableController;
use ModelModuleTest\TestSuite;

class ContenutiEnableDisableControllerTest extends TestSuite
{
    /**
     * @var ContenutiEnableDisableController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiEnableDisableController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testEnableAction()
    {
        $this->routeMatch->setParam('action', 'enable');
        $this->routeMatch->setParam('id', 880);

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDisableAction()
    {
        $this->routeMatch->setParam('action', 'disable');
        $this->routeMatch->setParam('id', 880);

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
