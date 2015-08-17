<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneDeleteController;
use Zend\Http\Request;
use ModelModuleTest\TestSuite;

class AttiConcessioneDeleteControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneDeleteController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsNotDirectlyAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    /*
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
    */
}
