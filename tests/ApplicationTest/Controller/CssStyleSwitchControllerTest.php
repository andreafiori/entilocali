<?php

namespace ApplicationTest\Controller;

use ModelModuleTest\TestSuite;
use Application\Controller\CssStyleSwitchController;
use ServiceLocatorFactory\ServiceLocatorFactory;

class CssStyleSwitchControllerTest extends TestSuite
{
    /**
     * @var CssStyleSwitchController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new CssStyleSwitchController();
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}