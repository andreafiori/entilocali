<?php

namespace AdminTest\Controller\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Controller\AlboPretorio\AlboPretorioSummaryController;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class AlboPretorioSummaryControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioSummaryController();
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
