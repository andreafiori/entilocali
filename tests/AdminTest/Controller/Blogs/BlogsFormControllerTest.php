<?php

namespace AdminTest\Controller\Blogs;

use Admin\Controller\Blogs\BlogsFormController;
use ModelModuleTest\TestSuite;

class BlogsFormControllerTest extends TestSuite
{
    /**
     * @var BlogsFormController
     */
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new BlogsFormController();
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
