<?php

namespace ApplicationTest\Controller\AttiConcessione;

use Application\Controller\Autocertificazioni\AutocertificazioniDemograficoController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

class AutocertificazioniDemograficoControllerTest extends TestSuite
{
    /**
     * @var AutocertificazioniDemograficoController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new AutocertificazioniDemograficoController();
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testDichiarazioneresidenza1ActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'dichiarazioneresidenza1');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDichiarazioneresidenza2ActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'dichiarazioneresidenza2');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDichiarazioneattonotorieta1ActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'dichiarazioneattonotorieta1');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testDichiarazioneattonotorieta2ActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'dichiarazioneattonotorieta2');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
