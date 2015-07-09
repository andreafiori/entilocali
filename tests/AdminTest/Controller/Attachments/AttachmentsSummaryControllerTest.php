<?php

namespace AdminTest\Controller\Attachments;

use Admin\Controller\Attachments\AttachmentsSummaryController;
use ModelModuleTest\TestSuite;

class AttachmentsSummaryControllerTest extends TestSuite
{
    /**
     * @var AttachmentsSummaryController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttachmentsSummaryController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexActionIsAccessible()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
