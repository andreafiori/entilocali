<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\ModalitaAssegnazioneUpdateController;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneForm;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ModalitaAssegnazioneUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ModalitaAssegnazioneUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ModalitaAssegnazioneUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome' => 'Mod. Assegnazione 1 test',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse( $form->isValid() );
    }

    /**
     * @param array $formDataSample
     * @return AttiConcessioneModalitaAssegnazioneForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new AttiConcessioneModalitaAssegnazioneForm();

        $inputFilter = new AttiConcessioneModalitaAssegnazioneFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
