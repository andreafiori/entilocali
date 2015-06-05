<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriFormController;
use ModelModuleTest\TestSuite;

class SettoriFormControllerTest extends TestSuite
{
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriFormController();
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
