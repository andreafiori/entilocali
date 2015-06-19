<?php

namespace AdminTest\Controller\Blogs;

use Admin\Controller\Blogs\BlogsDeleteController;
use ModelModuleTest\TestSuite;
use Zend\Http\PhpEnvironment\Request;

class BlogsDeleteControllerTest extends TestSuite
{
    /**
     * @var BlogsDeleteController
     */
    private  $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new BlogsDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('languageSelection', 'it');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'deleteId' => 1,
        ));

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
