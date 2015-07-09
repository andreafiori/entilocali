<?php

namespace AdminTest\Controller\AttiConcessione;

use Admin\Controller\AttiConcessione\AttiConcessioneUpdateController;
use ModelModule\Model\AttiConcessione\AttiConcessioneForm;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class AttiConcessioneUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var AttiConcessioneUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttiConcessioneUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'titolo'                => 'Atto 1 test',
            'beneficiario'          => 'Beneficiario test',
            'importo'               => 1230,
            'modAssegnazione'       => 1,
            'dataInserimento'       => '2015-01-01 01:01:00',
            'anno'                  => 2015,
            'settore'               => 1,
            'respProc'              => 1,
            'ufficioResponsabile'   => 1,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    protected function setupForm($formDataSample)
    {
        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile(array(
            1 => 'Ufficio 1',
            2 => 'Ufficio 2'
        ));
        $form->addResponsabileProcedimento(array(
            1 => 'Responsabile 1',
            2 => 'Responsabile 2',
        ));
        $form->addModalitaAssegnazione(array(
            1 => 'Modalita 1',
            2 => 'Modalita 2',
        ));
        $form->addTitoloDataInserimentoEAnno();

        $inputFilter = new AttiConcessioneFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
