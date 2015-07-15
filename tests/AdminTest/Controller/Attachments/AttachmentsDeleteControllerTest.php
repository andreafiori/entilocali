<?php

namespace AdminTest\Controller\Attachments;

use Admin\Controller\Attachments\AttachmentsDeleteController;
use ModelModuleTest\TestSuite;

class AttachmentsDeleteControllerTest extends TestSuite
{
    /**
     * @var AttachmentsDeleteController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttachmentsDeleteController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsNotDirectlyAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}