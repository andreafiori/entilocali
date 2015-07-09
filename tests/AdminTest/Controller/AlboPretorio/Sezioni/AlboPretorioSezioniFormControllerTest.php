<?php

namespace AdminTest\Controller\AlboPretorio\Sezioni;

use Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniFormController;
use ModelModuleTest\TestSuite;

class AlboPretorioSezioniFormControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioSezioniFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioSezioniFormController();
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
