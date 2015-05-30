<?php

namespace AdminTest\Controller\AlboPretorio;

use ModelModuleTest\TestSuite;
use Admin\Controller\AlboPretorio\AlboPretorioOperationsController;
use Zend\Http\Request;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class AlboPretorioOperationsControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioOperationsController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $sm = $this->getServiceManager();

        $this->request = new Request(); // override request

        $sm->setService('request', $this->request);

        $this->controller = new AlboPretorioOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($sm);
    }

    public function testPublishAction()
    {
        $this->routeMatch->setParam('action', 'publish');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testAnnullAction()
    {
        $this->routeMatch->setParam('action', 'annull');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}