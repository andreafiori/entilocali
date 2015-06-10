<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteUpdateController;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteForm;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContrattiPubbliciSceltaContraenteUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContrattiPubbliciSceltaContraenteUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciSceltaContraenteUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'                    => '',
            'nomeScelta'            => 'Voce scelta contraente',
            'attivo'                => 1,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nomeScelta']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse( $form->isValid() );
    }

    protected function setupForm($formDataSample)
    {
        $form = new SceltaContraenteForm();

        $inputFilter = new SceltaContraenteFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
