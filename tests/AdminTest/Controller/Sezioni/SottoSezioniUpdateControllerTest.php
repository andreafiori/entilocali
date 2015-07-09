<?php

namespace AdminTest\Controller\Sezioni;

use Admin\Controller\Sezioni\SottoSezioniUpdateController;
use ModelModule\Model\Sezioni\SottoSezioniForm;
use ModelModule\Model\Sezioni\SottoSezioniFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class SottoSezioniUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var SottoSezioniUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new SottoSezioniUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->routeMatch->setParam('modulename', 'contenuti');

        $this->formDataSample = array(
            'idSottoSezione'    => 1,
            'sezione'           => 1,
            'nomeSottoSezione'  => 1,
            'attivo'            => 1,
            'url'               => 'http://www.myurl.com',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['sezione']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return SottoSezioniForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new SottoSezioniForm();
        $form->addMainFormInputs();
        $form->addSezioni(array(
            1 => 'Sezione 1',
            2 => 'Sezione 2'
        ));

        $inputFilter = new SottoSezioniFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
