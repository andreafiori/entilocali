<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesPermissionsGetter;
use Admin\Model\Users\Roles\UsersRolesPermissionsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersRolesPermissionsGetterWrapper(
            new UsersRolesPermissionsGetter($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}