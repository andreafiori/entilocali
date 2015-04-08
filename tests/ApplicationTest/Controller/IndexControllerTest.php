<?php

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class IndexControllerTest // extends TestSuite
{
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $serviceManager = $this->serviceManager;
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('doctrine.entitymanager.orm_default', $this->getEntityManagerMock());

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