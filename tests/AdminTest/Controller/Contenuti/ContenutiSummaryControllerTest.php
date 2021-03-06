<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiSummaryController;
use ModelModuleTest\TestSuite;

class ContenutiSummaryControllerTest extends TestSuite
{
    /**
     * @var ContenutiSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->setupUserSession($this->recoverUserDetails());
    }

    public function testIndexActionIsAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
