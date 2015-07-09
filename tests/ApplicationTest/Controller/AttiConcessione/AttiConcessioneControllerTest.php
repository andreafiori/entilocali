<?php

namespace ApplicationTest\Controller\AttiConcessione;

use Application\Controller\AttiConcessione\AttiConcessioneController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

class AttiConcessioneControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new AttiConcessioneController();
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