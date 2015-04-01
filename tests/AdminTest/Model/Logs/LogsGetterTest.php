<?php

namespace AdminTest\Model\Logs;

use ApplicationTest\TestSuite;
use Admin\Model\Logs\LogsGetter;

/**
 * @author Andrea Fiori
 * @since  17 February 2015
 */
class LogsGetterTest extends TestSuite
{
    /**
     * @var LogsGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new LogsGetter($this->getEntityManagerMock());
    }

    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();

        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }

    public function testSetId()
    {
        $this->objectGetter->setId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId( array(1,2,3) );

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetUserId()
    {
        $this->objectGetter->setUserId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('userId'));
    }
}
