<?php

namespace AdminTest\Model\Users\RespProc;

use ApplicationTest\TestSuite;
use Admin\Model\Users\RespProc\UsersRespProcGetter;

/**
 * @author Andrea Fiori
 * @since  02 April 2015
 */
class UsersRespProcGetterTest extends TestSuite
{
    /**
     * @var UsersRespProcGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new UsersRespProcGetter($this->getEntityManagerMock());
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

    public function testSetExcludeId()
    {
        $this->objectGetter->setExcludeId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeId'));
    }
}