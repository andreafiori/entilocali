<?php

namespace ModelModuleTest\Model\Users\Roles;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetterWrapper;

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