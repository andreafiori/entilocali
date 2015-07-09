<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteInsertController;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteForm;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContrattiPubbliciSceltaContraenteInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContrattiPubbliciSceltaContraenteInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciSceltaContraenteInsertController();
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
