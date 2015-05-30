<?php

namespace ModelModuleTest\Model\Users\Roles;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  28 February 2015
 */
class UsersRolesGetterWrapperTest extends TestSuite
{
    /**
     * @var UsersRolesGetterWrapper
     */
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
