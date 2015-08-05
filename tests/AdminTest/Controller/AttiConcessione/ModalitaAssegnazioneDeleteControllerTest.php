<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\ModalitaAssegnazioneDeleteController;
use ModelModuleTest\TestSuite;

class ModalitaAssegnazioneDeleteControllerTest //extends TestSuite
{
    /**
     * @var ModalitaAssegnazioneDeleteController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ModalitaAssegnazioneDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }
}
