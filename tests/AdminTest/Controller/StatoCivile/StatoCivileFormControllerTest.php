<?php

namespace AdminTest\Controller\StatoCivile;

use Admin\Controller\StatoCivile\StatoCivileFormController;
use ApplicationTest\TestSuite;

class StatoCivileFormControllerTest extends TestSuite
{
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileFormController();
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