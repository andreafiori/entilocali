<?php

namespace AdminTest\Controller\ContrattiPubblici\Operatori;

use Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriInsertController;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriForm;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContrattiPubbliciOperatoriInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContrattiPubbliciOperatoriInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciOperatoriInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'                => '',
            'nome'              => 'Azienda test',
            'cf'                => 'FRINDR82M10A290M',
            'ragioneSociale'    => 'S.p.a.',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['nome']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param array $formDataSample
     * @return OperatoriForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new OperatoriForm();

        $inputFilter = new OperatoriFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
