<?php

namespace ApplicationTest\Controller\AlboPretorio;

use ModelModuleTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Application\Controller\AlboPretorio\AlboPretorioController;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class AlboPretorioControllerTest extends TestSuite
{
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new AlboPretorioController();
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
}