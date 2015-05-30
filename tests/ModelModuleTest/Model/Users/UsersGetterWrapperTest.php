<?php

namespace ModelModuleTest\Model\Users;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class UsersGetterWrapperTest extends TestSuite
{
    /**
     * @var UsersGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersGetterWrapper( new UsersGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
