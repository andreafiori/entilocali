<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiTabellaFormController;
use ModelModuleTest\TestSuite;

class ContenutiTabellaFormControllerTest extends TestSuite
{
    /**
     * @var ContenutiTabellaFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiTabellaFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $this->routeMatch->setParam('languageSelection', 'it');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
