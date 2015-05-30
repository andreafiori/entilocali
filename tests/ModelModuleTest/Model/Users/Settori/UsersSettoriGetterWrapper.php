<?php

namespace ModelModuleTest\Model\Users\Settori;

use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  29 March 2015
 */
class UsersSettoriGetterWrapperTest extends TestSuite
{
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}