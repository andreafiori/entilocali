<?php

namespace ModelModuleTest\Model\Users\Roles;

use ModelModuleTest\CrudHandlerTestSuite;
use ModelModule\Model\Users\Roles\UsersRolesCrudHandler;

class UsersSettoriCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var UsersRolesCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new UsersRolesCrudHandler();

        $this->formSampleData = array(
            'id'            => '',
            'name'          => 'New roles',
            'description'   => 'This is a description of the new role',
            'adminAccess'   => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->name);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->description);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->adminAccess);
    }
}