<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteFormController;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciSceltaContraenteFormControllerTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciSceltaContraenteFormController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciSceltaContraenteFormController();
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
