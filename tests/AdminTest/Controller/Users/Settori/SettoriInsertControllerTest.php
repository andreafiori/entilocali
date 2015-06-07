<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriInsertController;
use ModelModuleTest\TestSuite;

class SettoriInsertControllerTest extends TestSuite
{
    /**
     * @var SettoriInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
