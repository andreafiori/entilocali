<?php

namespace AdminTest\Controller\Attachments;

use Admin\Controller\Attachments\AttachmentsOperationsController;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class AttachmentsOperationsControllerTest extends TestSuite
{
    /**
     * @var AttachmentsOperationsController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttachmentsOperationsController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray(array(
            'id'                        => 1,
            'attiConcessioneColonna'    => 2,
        ));
    }

    public function testUpdatecolumnattachmentActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'updatecolumnattachment');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testUpdatecolumnattachmentActionReturnsRedirectWithReferer()
    {
        $this->routeMatch->setParam('action', 'updatecolumnattachment');

        $this->request->getHeaders()->addHeader($this->recoverRefererSample());

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }
}
