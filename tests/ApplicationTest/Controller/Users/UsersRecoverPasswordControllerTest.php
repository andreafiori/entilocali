<?php

namespace ApplicationTest\Controller\Users;

use Application\Controller\Users\UsersRecoverPasswordController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  19 April 2015
 */
class UsersRecoverPasswordControllerTest extends TestSuite
{
    /**
     * @var UsersRecoverPasswordController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new UsersRecoverPasswordController();
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
