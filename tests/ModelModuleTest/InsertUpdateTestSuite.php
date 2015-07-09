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
        $form->prepare();

        try {
            $csrf = $form->get('csrf');
            if ($csrf) {
                $params = new \Zend\Stdlib\Parameters(
                    array_merge(
                        $this->formDataSample,
                        array('csrf' => $form->get('csrf')->getValue() )
                    )
                );

                $form->setData($params);
            }
        } catch(\Zend\Form\Exception\InvalidElementException $e) {

        }

        if (is_object($form)) {
            $isValidForm = $form->isValid();
        }

        // $this->printFormElementErrors($form->getInputFilter());

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
            echo $key." - ".print_r($value->getMessages(), 1)."\n";
        }
    }

    abstract public function testFormSampleDataIsNotValid();

    abstract protected function setupForm($formDataSample);
}