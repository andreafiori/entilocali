<?php

namespace ModelModuleTest\Model\Users\Roles;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsRelationsGetterTest extends TestSuite
{
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new UsersRolesPermissionsRelationsGetter($this->getEntityManagerMock());
    }

    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();

        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }

    public function testSetRoleId()
    {
        $this->objectGetter->setRoleID(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('roleId'));
    }
}