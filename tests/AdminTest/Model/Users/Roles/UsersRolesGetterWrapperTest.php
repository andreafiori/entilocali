<?php

namespace AdminTest\Model\Users;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  28 February 2015
 */
class UsersRolesGetterWrapperTest extends TestSuite
{
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersRolesGetterWrapper( new UsersRolesGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
