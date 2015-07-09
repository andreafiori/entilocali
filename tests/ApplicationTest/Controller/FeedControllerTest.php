<?php

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  26 December 2013
 */
class FeedControllerTest // extends TestSuite
{
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
        
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
}