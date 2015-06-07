<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniSummaryController;
use Admin\Controller\Sezioni\SottoSezioniSummaryController;
use ModelModuleTest\TestSuite;

class SottoSezioniSummaryControllerTest extends TestSuite
{
    /**
     * @var SottoSezioniSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SottoSezioniSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->setupUserSession($this->recoverUserDetails());

        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
