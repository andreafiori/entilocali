<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneSummaryController;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  28 April 2015
 */
class AttiConcessioneSummaryControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneSummaryController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneSummaryController();
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
