<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SezioniUpdateController;
use ModelModule\Model\Sezioni\SezioniForm;
use ModelModule\Model\Sezioni\SezioniFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class SezioniUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var SezioniUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SezioniUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome'      => 'Sezione test',
            'lingua'    => 'it',
            'colonna'   => 'sx',
            'attivo'    => 1,
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
     * @return SezioniForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new SezioniForm();
        $form->addLingue(array(
            'it' => 'Italiano',
            'en' => 'English'
        ));
        $form->addIconImage();
        $form->addOptions();

        $inputFilter = new SezioniFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
