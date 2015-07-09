<?php

namespace AdminTest\Controller\ContrattiPubblici\Operatori;

use Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriUpdateController;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriForm;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContrattiPubbliciOperatoriUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContrattiPubbliciOperatoriUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContrattiPubbliciOperatoriUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'                => '',
            'nome'              => 'Azienda test',
            'cf'                => 'FCZ104AM120M',
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
     *
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
