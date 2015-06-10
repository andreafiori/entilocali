<?php

namespace AdminTest\Controller\Users\Settori;

use Admin\Controller\Users\Settori\SettoriInsertController;
use ModelModule\Model\Users\Settori\UsersSettoriForm;
use ModelModule\Model\Users\Settori\UsersSettoriFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class SettoriInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var SettoriInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SettoriInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome'                  => 'Settore test',
            'responsabileUserId'    => 1,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    protected function setupForm($formDataSample)
    {
        $form = new UsersSettoriForm();

        $inputFilter = new UsersSettoriFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
