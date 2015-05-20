<?php

namespace AdminTest\Model\Users;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Users\UsersCrudHandler;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class UsersCrudHandlerTest //extends CrudHandlerTestSuite
{
    /**
     * @var UsersCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new UsersCrudHandler();

        $this->formSampleData = array(
            'id'                    => '',
            'name'                  => 'John',
            'surname'               => 'Doe',
            'email'                 => 'john@doe.com',
            'username'              => 'johnDoeUser',
            'password'              => 'myPassword',
            'password_verify'       => 'myPassword',
            'roleId'                => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->name);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->surname);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->email);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->username);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->password);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->roleId);
    }
}