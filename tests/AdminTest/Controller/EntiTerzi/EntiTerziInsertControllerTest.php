<?php

namespace AdminTest\Controller\EntiTerzi;

use Admin\Controller\EntiTerzi\EntiTerziInsertController;
use ModelModule\Model\EntiTerzi\EntiTerziForm;
use ModelModule\Model\EntiTerzi\EntiTerziFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class EntiTerziInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var EntiTerziInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new EntiTerziInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome'  => 'Ente terzo test',
            'email' => 'ente@entemail.com',
        );
    }

    protected function setupForm($formDataSample)
    {
        $form = new EntiTerziForm();

        $inputFilter = new EntiTerziFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }
}