<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummaryController;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciSummaryControllerTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciSummaryController();
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
