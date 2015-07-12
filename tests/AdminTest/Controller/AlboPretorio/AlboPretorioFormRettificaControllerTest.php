<?php

namespace AdminTest\Controller\AlboPretorio;

use Admin\Controller\AlboPretorio\AlboPretorioFormRettificaController;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class AlboPretorioFormRettificaControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioFormRettificaController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioFormRettificaController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsNotDirectlyAccessible()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('lang', 'it');

        $this->setupUserSession($this->recoverUserDetails());

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('lang', 'it');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array('revisionId' => 1));

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
