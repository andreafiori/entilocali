<?php

namespace AdminTest\Controller\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Controller\AlboPretorio\AlboPretorioFormController;

/**
 * @author Andrea Fiori
 * @since  08 April 2015
 */
class AlboPretorioFormControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioFormController();
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
