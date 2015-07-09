<?php

namespace ModelModuleTest\Model\EntiTerzi;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Log\LogGetter;
use ModelModule\Model\Log\LogGetterWrapper;

class LogGetterWrapperTest extends TestSuite
{
    /**
     * @var LogGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new LogGetterWrapper( new LogGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
