<?php

namespace AdminTest\Controller\AlboPretorio;

use Admin\Controller\AlboPretorio\AlboPretorioInsertController;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class AlboPretorioInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var AlboPretorioInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AlboPretorioInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'                    => 1,
            'titolo'                => 'Albo pretorio test 1',
            'numeroAtto'            => 'Albo pretorio test 1',
            'anno'                  => 2015,
            'enteTerzo'             => 'ente terzo test',
            'fonteUrl'              => '',
            'sezione'               => 1,
            'numeroGiorniScadenza'  => '',
            /* 'dataScadenza'          => date("Y-m-d H:i:s"), */
            'homepage'              => 1,
            'facebook'              => '',
            'note'                  => 'note test rettifica',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return AlboPretorioArticoliForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new AlboPretorioArticoliForm();
        $form->addTitolo();
        $form->addSezioni(array(
           1 => 'Sezione 1 test',
           2 => 'Sezione 2 test',
           3 => 'Sezione 3 test',
        ));
        $form->addNumero();
        $form->addAnno();
        $form->addMainFields();
        $form->addScadenze();
        $form->addHomePage();
        $form->addFacebook();
        $form->addNote();

        $inputFilter = new AlboPretorioArticoliFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
