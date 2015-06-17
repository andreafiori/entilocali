<?php

namespace AdminTest\Controller\Posts;

use Admin\Controller\Posts\PostsCategoriesSummaryController;
use ModelModuleTest\TestSuite;

class PostsCategoriesSummaryControllerTest extends TestSuite
{
    /**
     * @var PostsCategoriesSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new PostsCategoriesSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->setupUserSession($this->recoverUserDetails());

        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('moduleCode', 'blogs');
        $this->routeMatch->setParam('languageSelection', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
