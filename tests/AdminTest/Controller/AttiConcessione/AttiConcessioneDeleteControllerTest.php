<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneDeleteController;
use ModelModuleTest\TestSuite;

class AttiConcessioneDeleteControllerTest extends TestSuite
{
    /**
     * @var AttiConcessioneDeleteController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }
}
