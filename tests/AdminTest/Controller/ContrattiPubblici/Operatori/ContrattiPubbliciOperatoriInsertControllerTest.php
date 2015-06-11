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
            'cf'                => 'FCZ104AM120M',
            'ragioneSociale'    => 'Spa',
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
        $form = new OperatoriForm();

        $inputFilter = new OperatoriFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
