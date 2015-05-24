<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiSummaryController;
use ApplicationTest\TestSuite;

class ContenutiSummaryControllerTest extends TestSuite
{
    /**
     * @var ContenutiSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiSummaryController();
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