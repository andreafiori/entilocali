<?php

namespace ApplicationTest\Controller\Cookie;

use Application\Controller\CookieWarningController;
use ModelModuleTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;

class CookieWarningControllerTest extends TestSuite
{
    /**
     * @var CookieWarningController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new CookieWarningController();
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testConfirmActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'confirm');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testConfirmActionReturnsRedirectWithReferer()
    {
        $this->routeMatch->setParam('action', 'confirm');

        $this->request->getHeaders()->addHeader($this->recoverRefererSample());

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testDenyActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'deny');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testDenyActionReturnsRedirectWithReferer()
    {
        $this->routeMatch->setParam('action', 'deny');

        $this->request->getHeaders()->addHeader($this->recoverRefererSample());

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
