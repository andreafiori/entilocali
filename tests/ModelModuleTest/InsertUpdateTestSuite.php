<?php

namespace ModelModuleTest;

use Zend\Http\Request;

/**
 * TestSuite for Insert and Update controllers types
 */
abstract class InsertUpdateTestSuite extends TestSuite
{
    protected $formDataSample;

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    public function testIndexActionReturnsRedirect()
    {
        $this->setupUserSession($this->recoverUserDetails());

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

        $isValidForm = $form->isValid();

        //$this->printFormElementErrors($form->getInputFilter());

        $this->assertTrue($isValidForm);
    }

    /**
     * DEBUG Form: $this->printFormElementErrors($form->getInputFilter());
     *
     * @param $inputFilter
     */
    protected function printFormElementErrors($inputFilter)
    {
        echo "\nFORM DEBUG: \n";
        $formValidationErrors = $inputFilter->getInvalidInput();
        foreach($formValidationErrors as $key => $value) {
            echo $key."\n";
        }
    }

    abstract protected function setupForm($formDataSample);

    abstract public function testFormSampleDataIsNotValid();
}