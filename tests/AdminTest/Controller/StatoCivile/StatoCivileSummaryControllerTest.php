<?php

namespace AdminTest\Controller\StatoCivile;

use Admin\Controller\StatoCivile\StatoCivileSummaryController;
use ModelModuleTest\TestSuite;

class StatoCivileSummaryControllerTest extends TestSuite
{
    /**
     * @var StatoCivileSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileSummaryController();
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