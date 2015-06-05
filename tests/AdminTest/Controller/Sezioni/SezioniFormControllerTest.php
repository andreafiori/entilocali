<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniFormController;
use ModelModuleTest\TestSuite;

class SezioniFormControllerTest extends TestSuite
{
    /**
     * @var SezioniFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SezioniFormController();
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
