<?php

namespace ModelModuleTest\Model\Users\Todo;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Users\Todo\UsersTodoGetter;
use ModelModule\Model\Users\Todo\UsersTodoGetterWrapper;

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
