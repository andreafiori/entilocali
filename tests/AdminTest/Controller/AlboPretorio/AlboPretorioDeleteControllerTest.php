<?php

namespace AdminTest\Controller\AlboPretorio;

use Admin\Controller\AlboPretorio\AlboPretorioDeleteController;
use Zend\Http\Request;
use ModelModuleTest\TestSuite;

class AlboPretorioDeleteControllerTest extends TestSuite
{
    /**
     * @var AlboPretorioDeleteController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $sm = $this->getServiceManager();

        $this->request = new Request();

        $sm->setService('request', $this->request);

        $this->controller = new AlboPretorioDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($sm);
    }

    public function testIndexAction()
    {
        $this->assertFalse( $this->controller->indexAction() );
    }
}