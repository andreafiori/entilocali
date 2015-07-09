<?php

namespace AdminTest\Controller\AlboPretorio\Sezioni;

use Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniInsertController;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniForm;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class AlboPretorioSezioniInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var AlboPretorioSezioniInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioSezioniInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'nome'      => 'Sezione albo test',
            'attivo'    => 1
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
     * @return AlboPretorioSezioniForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new AlboPretorioSezioniForm();

        $inputFilter = new AlboPretorioSezioniFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
