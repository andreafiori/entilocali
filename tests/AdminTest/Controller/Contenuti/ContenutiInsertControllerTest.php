<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiInsertController;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class ContenutiInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var ContenutiInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'titolo'            => 'My Content Title',
            'sommario'          => 'My Content SubTitle',
            'testo'             => 'My Large Text',
            'sottosezione'      => 1,
            'dataInserimento'   => '2015-05-28 01:01:00',
            'dataScadenza'      => '2015-05-28 01:01:00',
            'attivo'            => 1,
            'home'              => 1,
            'rss'               => 1,
            'utente'            => 1,
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
     * @return ContenutiForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new ContenutiForm();
        $form->addSottoSezioni(array(
            1 => 'Sottosezione 1',
            2 => 'Sottosezione 2',
        ));
        $form->addMainFormElements();
        $form->addUsers(array(
            1 => 'John Doe',
            2 => 'Jack Black',
        ));
        $form->addHomeBox();
        $form->addSocial();

        $inputFilter = new ContenutiFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
