<?php

namespace AdminTest\Controller\HomePage;

use Admin\Controller\HomePage\HomePageController;
use ModelModuleTest\TestSuite;

class HomePageControllerTest extends TestSuite
{
    /**
     * @var HomePageController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new HomePageController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('lang', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}