<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesPermissionsCrudHandler;

/**
 * @author Andrea Fiori
 * @since  13 March 2015
 */
class UsersRolesPermissionsCrudHandlerTest // extends TestSuite
{
    /**
     * @var UsersRolesPermissionsCrudHandler
     */
    private $usersRolesPermissionsCrudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->usersRolesPermissionsCrudHandler = new UsersRolesPermissionsCrudHandler(
            $this->getFrontendCommonInput()
        );
        // $this->usersRolesPermissionsCrudHandler->setInput();
        $this->usersRolesPermissionsCrudHandler->setConnection($this->getEntityManagerMock()->getConnection());
    }

    public function testInsert()
    {

    }

    public function testUpdate()
    {

    }
}