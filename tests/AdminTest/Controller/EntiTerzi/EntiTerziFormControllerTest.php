<?php

namespace Admin\Controller\EntiTerzi;

use ModelModuleTest\TestSuite;

class EntiTerziFormControllerTest extends TestSuite
{
    /**
     * @var EntiTerziFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new EntiTerziFormController();
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