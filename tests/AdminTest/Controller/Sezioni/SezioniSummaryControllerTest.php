<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniSummaryController;
use ModelModuleTest\TestSuite;

class SezioniSummaryControllerTest extends TestSuite
{
    /**
     * @var SezioniSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SezioniSummaryController();
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
