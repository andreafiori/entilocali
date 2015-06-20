<?php

namespace AdminTest\Controller\EntiTerzi;

use Admin\Controller\EntiTerzi\EntiTerziSummaryController;
use ModelModuleTest\TestSuite;

class EntiTerziSummaryControllerTest extends TestSuite
{
    /**
     * @var EntiTerziSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new EntiTerziSummaryController();
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