<?php

namespace AdminTest\Controller\Tickets;

use Admin\Controller\Tickets\TicketsFormController;
use ApplicationTest\TestSuite;

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

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
