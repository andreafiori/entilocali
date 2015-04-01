<?php

namespace AdminTest\Model\Users\Todo;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Todo\UsersTodoGetter;
use Admin\Model\Users\Todo\UsersTodoGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  29 March 2015
 */
class UsersTodoGetterWrapperTest extends TestSuite
{
    /**
     * @var UsersTodoGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new UsersTodoGetterWrapper( new UsersTodoGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
