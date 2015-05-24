<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\Log\LogGetter;
use Admin\Model\Log\LogGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
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
