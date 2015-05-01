<?php

namespace AdminTest\Controller\Attachments;

use Admin\Controller\Attachments\AttachmentsFormController;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  28 April 2015
 */
class AttachmentsFormControllerTest extends TestSuite
{
    /**
     * @var AttachmentsFormController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttachmentsFormController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }
}
