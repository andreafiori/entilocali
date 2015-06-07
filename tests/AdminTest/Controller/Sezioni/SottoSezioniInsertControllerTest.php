<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniSummaryController;
use Admin\Controller\Sezioni\SottoSezioniInsertController;
use Admin\Controller\Sezioni\SottoSezioniSummaryController;
use ModelModuleTest\TestSuite;

class SottoSezioniInsertControllerTest extends TestSuite
{
    /**
     * @var SottoSezioniInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SottoSezioniInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->setupUserSession($this->recoverUserDetails());

        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
