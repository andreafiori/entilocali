<?php

namespace AdminTest\Controller\ContrattiPubblici\Operatori;

use Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriSummaryController;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciOperatoriSummaryControllerTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciOperatoriSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciOperatoriSummaryController();
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
