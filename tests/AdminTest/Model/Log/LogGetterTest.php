<?php

namespace AdminTest\Model\Log;

use ApplicationTest\TestSuite;
use Admin\Model\Log\LogGetter;

class LogGetterTest extends TestSuite
{
    /**
     * @var LogGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new LogGetter($this->getEntityManagerMock());
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
