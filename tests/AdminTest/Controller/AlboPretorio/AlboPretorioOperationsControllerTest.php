<?php

namespace AdminTest\Controller\AlboPretorio;

use Admin\Controller\AlboPretorio\AlboPretorioOperationsController;
use Zend\Http\Request;
use ModelModuleTest\TestSuite;

class AlboPretorioOperationsControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioOperationsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $sm = $this->getServiceManager();

        $this->request = new Request();

        $sm->setService('request', $this->request);

        $this->controller = new AlboPretorioOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($sm);
    }

    public function testPublishActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'publish');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testPublishAction()
    {
        $this->routeMatch->setParam('action', 'publish');
        $this->routeMatch->setParam('lang', 'it');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray( array('publishId' => 1) );

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testAnnullAction()
    {
        $this->routeMatch->setParam('action', 'annull');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'annullId' => 1
        ));

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testAnnullActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'annull');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}