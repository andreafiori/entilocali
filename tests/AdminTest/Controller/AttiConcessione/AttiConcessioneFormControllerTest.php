<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneFormController;
use ModelModuleTest\TestSuite;

class AttiConcessioneFormControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
