<?php

namespace AdminTest\Controller\HomePage;

use Admin\Controller\HomePage\HomePageBlocksPositionsController;
use ModelModuleTest\TestSuite;

class HomePageBlocksPositionsControllerTest extends TestSuite
{
    /**
     * @var HomePageBlocksPositionsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new HomePageBlocksPositionsController();
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