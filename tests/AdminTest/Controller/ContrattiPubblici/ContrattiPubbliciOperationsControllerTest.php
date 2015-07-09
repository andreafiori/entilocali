<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciOperationsController;
use ModelModuleTest\TestSuite;

/**
 * Contratti Pubblici Additional Operations Controller
 */
class ContrattiPubbliciOperationsControllerTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciOperationsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testEnableAction()
    {
        $this->routeMatch->setParam('action', 'enable');
        $this->routeMatch->setParam('id', 1);

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDisableAction()
    {
        $this->routeMatch->setParam('action', 'disable');
        $this->routeMatch->setParam('id', 2);

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
