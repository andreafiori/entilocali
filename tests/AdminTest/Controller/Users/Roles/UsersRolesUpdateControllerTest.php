<?php

namespace AdminTest\Controller\Users\Roles;

use Admin\Controller\Users\Roles\UsersRolesUpdateController;
use ModelModule\Model\Users\Roles\UsersRolesForm;
use ModelModule\Model\Users\Roles\UsersRolesFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class UsersRolesUpdateControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var UsersRolesUpdateController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new UsersRolesUpdateController();
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
