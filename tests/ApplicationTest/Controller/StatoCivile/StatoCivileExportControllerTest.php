<?php

namespace ApplicationTest\Controller\StatoCivile;

use Application\Controller\StatoCivile\StatoCivileExportController;
use ServiceLocatorFactory\ServiceLocatorFactory;
use ModelModuleTest\TestSuite;

class StatoCivileExportControllerTest extends TestSuite
{
    /**
     * @var StatoCivileExportController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->controller = new StatoCivileExportController();
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testPdfActionIsRedirect()
    {
        $this->routeMatch->setParam('action', 'pdf');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testCsvActionIsRedirect()
    {
        $this->routeMatch->setParam('action', 'csv');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testTxtActionIsRedirect()
    {
        $this->routeMatch->setParam('action', 'txt');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
