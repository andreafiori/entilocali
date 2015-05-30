<?php

namespace ModelModuleTest\Model\Users\Roles;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsCrudHandler;

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

        $this->usersRolesPermissionsCrudHandler->setConnection($this->getEntityManagerMock()->getConnection());
    }
}