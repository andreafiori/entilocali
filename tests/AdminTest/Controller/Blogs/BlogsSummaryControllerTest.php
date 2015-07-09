<?php

namespace AdminTest\Controller\Blogs;

use Admin\Controller\Blogs\BlogsSummaryController;
use ModelModuleTest\TestSuite;

class BlogsSummaryControllerTest extends TestSuite
{
    /**
     * @var BlogsSummaryController
     */
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new BlogsSummaryController();
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
