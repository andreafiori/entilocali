<?php

namespace AdminTest\Controller\EntiTerzi;

use Admin\Controller\EntiTerzi\EntiTerziFormController;
use ModelModuleTest\TestSuite;

class EntiTerziFormControllerTest extends TestSuite
{
    /**
     * @var EntiTerziFormController
     */
    protected $controller;

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