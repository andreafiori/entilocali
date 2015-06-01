<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiInsertController;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class ContenutiInsertControllerTest extends TestSuite
{
    /**
     * @var ContenutiInsertController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testInsertAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'sottosezione_id'   => 1,
            'titolo'            => 'Content title',
            'sommario'          => 'Content subtitle',
            'testo'             => 'Content text',
            'data_inserimento'  => '2015-01-01 01:00:00',
            'data_scadenza'     => '2020-01-01 01:00:00',
            'attivo'            => 1,
            'slug'              => 'slugged-title',
            'home'              => 0,
            'rss'               => 0,
            'utente_id'         => 1
        ));

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexDirectAccessReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
