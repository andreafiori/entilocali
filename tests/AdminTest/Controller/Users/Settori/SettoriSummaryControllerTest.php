<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriSummaryController;
use ModelModuleTest\TestSuite;

class SettoriSummaryControllerTest extends TestSuite
{
    /**
     * @var SettoriSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriSummaryController();
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
