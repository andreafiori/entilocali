<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiUpdateController;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use Zend\Http\Request;
use ModelModuleTest\TestSuite;

class ContenutiUpdateControllerTest extends TestSuite
{
    /**
     * @var ContenutiUpdateController
     */
    protected $controller;

    private $formDataSample;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiUpdateController();
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
            'id'                => 1,
        );
    }

    public function testFormSampleIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param $formDataSample
     * @return ContenutiForm
     */
    private function setupForm($formDataSample)
    {
        $form = new ContenutiForm();
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
