<?php

namespace AdminTest\Controller\AlboPretorio;

use ModelModuleTest\TestSuite;
use Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController;

class AlboPretorioRelataPdfControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioRelataPdfController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioRelataPdfController();
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
