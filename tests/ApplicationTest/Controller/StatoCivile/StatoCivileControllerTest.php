<?php

namespace ApplicationTest\Controller\StatoCivile;

use ModelModuleTest\TestSuite;
use Application\Controller\StatoCivile\StatoCivileController;
use ServiceLocatorFactory\ServiceLocatorFactory;

class StatoCivileControllerTest extends TestSuite
{
    /**
     * @var StatoCivileController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new StatoCivileController();
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
