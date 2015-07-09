<?php

namespace AdminTest\Controller\EntiTerzi;

use Admin\Controller\EntiTerzi\EntiTerziUpdateController;
use ModelModule\Model\EntiTerzi\EntiTerziForm;
use ModelModule\Model\EntiTerzi\EntiTerziFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class EntiTerziUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var EntiTerziUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new EntiTerziUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome'  => 'Ente terzo test',
            'email' => 'ente@entemail.com',
        );
    }

    public function testIndexActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return EntiTerziForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new EntiTerziForm();

        $inputFilter = new EntiTerziFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}