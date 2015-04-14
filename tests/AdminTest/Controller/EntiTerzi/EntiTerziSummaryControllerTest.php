<?php

namespace Admin\Controller\EntiTerzi;

use ApplicationTest\TestSuite;

class EntiTerziSummaryControllerTest extends TestSuite
{
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new EntiTerziSummaryController();
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