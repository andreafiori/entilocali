<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\Logs\LogsGetter;
use Admin\Model\Logs\LogsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class LogsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new LogsGetterWrapper( new LogsGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
