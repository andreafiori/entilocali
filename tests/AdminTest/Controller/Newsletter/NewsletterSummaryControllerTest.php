<?php

namespace AdminTest\Controller\Newsletter;

use Admin\Controller\Newsletter\NewsletterSummaryController;
use ModelModuleTest\TestSuite;

class NewsletterSummaryControllerTest extends TestSuite
{
    /**
     * @var NewsletterSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new NewsletterSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
