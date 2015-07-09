<?php

namespace AdminTest\Controller\Users;

use Admin\Controller\Users\UsersUpdateController;
use ModelModule\Model\Users\UsersForm;
use ModelModule\Model\Users\UsersFormInputFilter;
use Admin\Controller\Users\UsersInsertController;
use ModelModuleTest\InsertUpdateTestSuite;

class UsersUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var UsersInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'name'              => 'John',
            'surname'           => 'Doe',
            'email'             => 'johndoe@jdoe.com',
            'username'          => 'usernameTest',
            'password'          => 'passwordTest',
            'password_verify'   => 'passwordTest',
            'roleId'            => 1,
            'settoreId'         => 1,
        );
    }

    public function testFormPasswordVerifyNotMatch()
    {
        $this->formDataSample['password_verify'] = 'differentPassword';

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse( $form->isValid() );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['name']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse( $form->isValid() );
    }

    protected function setupForm($formDataSample)
    {
        $form = new UsersForm();
        $form->addSettori(array(
            1 => 'Settore 1',
            2 => 'Settore 2',
        ));
        $form->addRoles(array(
           1 => 'Role 1',
           2 => 'Role 2',
        ));

        $inputFilter = new UsersFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
