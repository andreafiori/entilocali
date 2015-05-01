<?php

namespace ApplicationTest\Controller\Users;

use Application\Controller\Users\UsersCreateAccountController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  17 April 2015
 */
class UsersCreateAccountControllerTest extends TestSuite
{
    /**
     * @var UsersCreateAccountController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new UsersCreateAccountController();
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