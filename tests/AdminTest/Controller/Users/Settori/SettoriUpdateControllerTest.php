<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriUpdateController;
use ModelModuleTest\TestSuite;

class SettoriUpdateControllerTest extends TestSuite
{
    /**
     * @var SettoriUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
