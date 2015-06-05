<?php

namespace AdminTest\Controller\StatoCivile;

use Admin\Controller\StatoCivile\StatoCivileInsertController;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class StatoCivileInsertControllerTest extends TestSuite
{
    /**
     * @var StatoCivileInsertController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionCorrectPostRequest()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'titolo'                => 'Primo atto stato civile',
            'anno'                  => date("Y"),
            'data'                  => date("Y-m-d"),
            'ora'                   => date("H:i:s"),
            'attivo'                => 1,
            'scadenza'              => date("Y-m-d H:i:s"),
            'utente_id'             => 1,
            'sezione_id'            => 1,
            'home'                  => 0,
        ));

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}