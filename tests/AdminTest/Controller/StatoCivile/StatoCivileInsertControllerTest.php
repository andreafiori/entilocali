<?php

namespace AdminTest\Controller\StatoCivile;

use Admin\Controller\StatoCivile\StatoCivileInsertController;
use ModelModule\Model\StatoCivile\StatoCivileForm;
use ModelModule\Model\StatoCivile\StatoCivileFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class StatoCivileInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var StatoCivileInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new StatoCivileInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'titolo'                => 'Primo atto stato civile',
            'anno'                  => date("Y"),
            'data'                  => date("Y-m-d"),
            'ora'                   => date("H:i:s"),
            'attivo'                => 1,
            'scadenza'              => date("Y-m-d H:i:s"),
            'utente'                => 1,
            'sezione'               => 1,
            'home'                  => 0,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return StatoCivileForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new StatoCivileForm();
        $form->addSezioni(array(
            1 => 'Sezione test 1',
            2 => 'Sezione test 2',
            3 => 'Sezione test 3',
        ));

        $inputFilter = new StatoCivileFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}