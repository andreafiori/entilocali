<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesPermissionsGetter;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsGetterTest extends TestSuite
{
    /**
     * @var UsersRolesPermissionsGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new UsersRolesPermissionsGetter($this->getEntityManagerMock());
    }

    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();

        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
}