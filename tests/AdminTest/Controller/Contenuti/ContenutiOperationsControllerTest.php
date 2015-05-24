<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiOperationsController;
use ApplicationTest\TestSuite;

class ContenutiOperationsControllerTest extends TestSuite
{
    /**
     * @var ContenutiOperationsController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testInsertAction()
    {
        $this->routeMatch->setParam('action', 'insert');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testUpdateAction()
    {
        $this->routeMatch->setParam('action', 'update');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
