<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesPermissionsHandler;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsHandlerTest extends TestSuite
{
    private $usersRolesPermissionsHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->usersRolesPermissionsHandler = new UsersRolesPermissionsHandler();
        $this->usersRolesPermissionsHandler->setInput($this->getFrontendCommonInput());
    }

    public function testSetupRecord()
    {
        $this->usersRolesPermissionsHandler->setupRecord();
    }
}