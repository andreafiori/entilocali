<?php

namespace ApplicationTest\Controller\AttiConcessione;

use Application\Controller\Autocertificazioni\AutocertificazioniController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

class AutocertificazioniControllerTest extends TestSuite
{
    /**
     * @var AutocertificazioniController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new AutocertificazioniController();
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDemograficoActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'demografico');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testPoliziamunicipaleActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'poliziamunicipale');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testServizisocialiActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'servizisociali');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testUfficiotecnicoActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'ufficiotecnico');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}