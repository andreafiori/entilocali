<?php

namespace AdminTest\Controller\StatoCivile\Sezioni;

use Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniFormController;
use ModelModuleTest\TestSuite;

class StatoCivileSezioniSummaryControllerTest extends TestSuite
{
    /**
     * @var StatoCivileSezioniFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileSezioniFormController();
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