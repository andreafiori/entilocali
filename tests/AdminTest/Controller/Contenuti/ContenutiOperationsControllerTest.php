<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiOperationsController;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class ContenutiOperationsControllerTest extends TestSuite
{
    /**
     * @var ContenutiOperationsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testChangesummarylangAction()
    {
        $this->routeMatch->setParam('action', 'changesummarylang');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testChangesummarylangActionReturnsRedirectAfterPost()
    {
        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'lingua' => 'en',
            'languageSelection' => 'it'
        ));

        $this->routeMatch->setParam('action', 'changesummarylang');
        $this->routeMatch->setParam('lang', 'it');
        $this->routeMatch->setParam('modulename', 'contenuti');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testSummarysearchAction()
    {
        $this->routeMatch->setParam('action', 'summarysearch');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
