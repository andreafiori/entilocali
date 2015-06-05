<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriFormController;
use Admin\Controller\Users\Settori\SettoriInsertController;
use ModelModuleTest\TestSuite;

class SettoriInsertControllerTest //extends TestSuite
{
    /**
     * @var SettoriInsertController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriInsertController();
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
