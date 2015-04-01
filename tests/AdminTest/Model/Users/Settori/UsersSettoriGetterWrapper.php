<?php

namespace AdminTest\Model\Users\Settori;

use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use ApplicationTest\TestSuite;

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