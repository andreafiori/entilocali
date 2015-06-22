<?php

namespace AdminTest\Controller\Newsletter;

use Admin\Controller\Newsletter\NewsletterFormController;
use ModelModuleTest\TestSuite;

class NewsletterFormControllerTest extends TestSuite
{
    /**
     * @var NewsletterFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new NewsletterFormController();
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
