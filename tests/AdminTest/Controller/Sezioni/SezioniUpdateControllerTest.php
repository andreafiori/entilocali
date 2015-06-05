<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniUpdateController;
use ModelModuleTest\TestSuite;

class SezioniUpdateControllerTest extends TestSuite
{
    /**
     * @var SezioniUpdateController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SezioniUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
