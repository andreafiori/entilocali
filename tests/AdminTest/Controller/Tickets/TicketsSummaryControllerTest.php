<?php

namespace AdminTest\Controller\Tickets;

use Admin\Controller\Tickets\TicketsFormController;
use Admin\Controller\Tickets\TicketsSummaryController;
use ApplicationTest\TestSuite;

class TicketsSummaryControllerTest extends TestSuite
{
    /**
     * @var TicketsFormController
     */
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new TicketsSummaryController();
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
