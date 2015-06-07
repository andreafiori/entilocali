<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiInsertController;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiFormInputFilter;
use ModelModuleTest\TestSuite;
use Zend\Http\Request;

class ContenutiInsertControllerTest extends TestSuite
{
    /**
     * @var ContenutiInsertController
     */
    protected $controller;

    private $formDataSample;

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

    public function testIndexActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionCorrectPostRequest()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->setupUserSession($this->recoverUserDetails());

        $this->request->setMethod(Request::METHOD_POST)->getPost()->fromArray($this->formDataSample);

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testFormSampleDataIsValid()
    {
        $form = $this->setupForm($this->formDataSample);

        $this->assertTrue($form->isValid());
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

    /**
     * DEBUG Form: $this->printFormElementErrors($form->getInputFilter());
     *
     * @param $inputFilter
     */
    private function printFormElementErrors($inputFilter)
    {
        echo "DEBUG: \n";
        $formValidationErrors = $inputFilter->getInvalidInput();
        foreach($formValidationErrors as $key => $value) {
            echo $key."\n";
        }
    }
}
