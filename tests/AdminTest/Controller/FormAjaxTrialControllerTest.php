<?php

namespace AdminTest\Controller;

use Admin\Controller\FormAjaxTrialController;
use ApplicationTest\TestSuite;
use Zend\Http\Request;
use Zend\Http\Response;

class FormAjaxTrialControllerTest extends TestSuite
{
    /**
     * @var FormAjaxTrialController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new FormAjaxTrialController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator( $this->getServiceManager() );
        $this->controller->setServiceLocator( $this->getServiceManager() );
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testAddActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'add');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testAddSimulatingPostRequest()
    {
        $this->routeMatch->setParam('action', 'add');

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array('foo' => 'bar'));

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}