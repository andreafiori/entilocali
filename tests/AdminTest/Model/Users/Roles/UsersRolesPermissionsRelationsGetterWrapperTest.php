<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;
use Admin\Model\Users\Roles\UsersRolesPermissionsRelationsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsRelationsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersRolesPermissionsRelationsGetterWrapper(
            new UsersRolesPermissionsRelationsGetter($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}