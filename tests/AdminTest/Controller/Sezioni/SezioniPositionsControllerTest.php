<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniPositionsController;
use ModelModuleTest\TestSuite;

class SezioniPositionsControllerTest extends TestSuite
{
    /**
     * @var SezioniPositionsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SezioniPositionsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('modulename', 'contenuti');
        $this->routeMatch->setParam('languageSelection', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
