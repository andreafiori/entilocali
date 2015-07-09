<?php

namespace ModelModuleTest\Model\Users\Todo;

use ModelModule\Model\Users\Todo\UsersTodoGetter;
use ModelModule\Model\Users\Todo\UsersTodoGetterWrapper;
use ModelModuleTest\TestSuite;

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
