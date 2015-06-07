<?php

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class IndexControllerTest extends TestSuite
{
    /**
     * @var IndexController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new IndexController();
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