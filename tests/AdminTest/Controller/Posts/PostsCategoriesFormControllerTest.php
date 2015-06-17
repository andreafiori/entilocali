<?php

namespace AdminTest\Controller\Posts;

use Admin\Controller\Posts\PostsCategoriesFormController;
use ModelModuleTest\TestSuite;

class PostsCategoriesFormControllerTest extends TestSuite
{
    /**
     * @var PostsCategoriesFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new PostsCategoriesFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->setupUserSession($this->recoverUserDetails());

        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('formtype', 'blogs');
        $this->routeMatch->setParam('languageSelection', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}