<?php

namespace AdminTest\Controller\Tickets;

use Admin\Controller\Tickets\TicketsFormController;
use ModelModuleTest\TestSuite;

class TicketsFormControllerTest extends TestSuite
{
    /**
     * @var TicketsFormController
     */
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new TicketsFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('lang', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
