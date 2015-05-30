<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiInsertController;
use ModelModuleTest\TestSuite;

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

    public function testIndexDirectAccessReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
