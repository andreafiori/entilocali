<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneSummaryController;
use ModelModuleTest\TestSuite;

class AttiConcessioneSummaryControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneSummaryController();
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
