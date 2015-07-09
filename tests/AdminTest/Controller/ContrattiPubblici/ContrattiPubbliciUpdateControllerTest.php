<?php

namespace AdminTest\Controller\ContrattiPubblici;

use Admin\Controller\ContrattiPubblici\ContrattiPubbliciUpdateController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciForm;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContrattiPubbliciUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContrattiPubbliciUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'                        => '',
            'cig'                       => 'Z102358012',
            'titolo'                    => 'Bando test',
            'beneficiario'              => 'Azienda test',
            'numeroDetermina'           => 1,
            'dataDetermina'             => '2015-01-02',
            'importoAggiudicazione'     => 1230,
            'importoLiquidato'          => 1210,
            'settoreId'                 => 1,
            'respProcId'                => 1,
            'numeroOfferte'             => 2,
            'dataInizioLavori'          => '2015-01-08 01:02:10',
            'dataFineLavori'            => '2015-01-08 01:02:10',
            'sceltaContraenteId'        => 1,
            'dataInserimento'           => '2014-01-08 01:02:10',
            'utenteId'                  => 1,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param array $formDataSample
     * @return ContrattiPubbliciForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new ContrattiPubbliciForm();
        $form->addDetermina();
        $form->addImporti();
        $form->addStrutturaProponenteLabel();
        $form->addSettori(array(
            1 => 'Settore 1',
            2 => 'Settore 2',
        ));
        $form->addResponsabili(array(
            1 => 'Responsabile 1',
            2 => 'Responsabile 2',
        ));
        $form->addNumeroOfferte();
        //$form->addDataInizioFineLavori();
        $form->addSceltaContraente(array(
            1 => 'Scelta contrante test 1',
            2 => 'Scelta contrante test 2',
        ));
        //$form->addDatePubblicazione();
        $form->addUsersSelect(array(
            1 => 'User 1',
            2 => 'User 2',
        ));

        $inputFilter = new ContrattiPubbliciFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
