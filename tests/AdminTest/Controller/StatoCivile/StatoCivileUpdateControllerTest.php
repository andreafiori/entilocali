<?php

namespace AdminTest\Controller\StatoCivile;

use Admin\Controller\StatoCivile\StatoCivileUpdateController;
use ModelModuleTest\TestSuite;

class StatoCivileUpdateControllerTest extends TestSuite
{
    /**
     * @var StatoCivileUpdateController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileUpdateController();
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