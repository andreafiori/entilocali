<?php

namespace ApplicationTest\Controller\Contenuti;

use ApplicationTest\TestSuite;
use Application\Controller\Contenuti\ContenutiController;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class ContenutiControllerTest extends TestSuite
{
    /**
     * @var ContenutiController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new ContenutiController();
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