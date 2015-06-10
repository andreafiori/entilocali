<?php

namespace AdminTest\Controller\StatoCivile\Sezioni;

use Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniInsertController;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniForm;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class StatoCivileSezioniInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var StatoCivileSezioniInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileSezioniInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'     => '',
            'nome'   => 'Nuova sezione',
            'attivo' => '1',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return StatoCivileSezioniForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new StatoCivileSezioniForm();

        $inputFilter = new StatoCivileSezioniFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}