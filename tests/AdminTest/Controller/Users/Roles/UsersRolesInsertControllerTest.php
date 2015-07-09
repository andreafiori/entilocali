<?php

namespace AdminTest\Controller\Users\Roles;

use Admin\Controller\Users\Roles\UsersRolesInsertController;
use ModelModule\Model\Users\Roles\UsersRolesForm;
use ModelModule\Model\Users\Roles\UsersRolesFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class UsersRolesInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var SettoriInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersRolesInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id' => '',
            'name' => 'RoleTest',
            'description' => 'This is role for test',
            'adminAccess' => '',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['name']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    protected function setupForm($formDataSample)
    {
        $form = new UsersRolesForm();

        $inputFilter = new UsersRolesFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
