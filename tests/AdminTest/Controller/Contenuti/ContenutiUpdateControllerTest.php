<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiUpdateController;
use Zend\Http\Request;
use ApplicationTest\TestSuite;

class ContenutiUpdateControllerTest extends TestSuite
{
    /**
     * @var ContenutiUpdateController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsNotAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionCorrectPostRequest()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'sottosezione_id'   => 1,
            'titolo'            => 'My Content Title',
            'sommario'          => 'My Content SubTitle',
            'testo'             => 'My Large Text',
            'data_inserimento'  => '2015-05-28 01:01:00',
            'data_scadenza'     => '2015-05-28 01:01:00',
            'attivo'            => 1,
            'home'              => 1,
            'rss'               => 1,
        ));

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
