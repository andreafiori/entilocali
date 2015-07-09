<?php

namespace ModelModuleTest\Model\Users\Settori;

use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use ModelModuleTest\TestSuite;

class UsersSettoriGetterWrapperTest extends TestSuite
{
    /**
     * @var UsersSettoriGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersSettoriGetterWrapper(
            new UsersSettoriGetter($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}