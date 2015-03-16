<?php

namespace AdminTest\Model\Users\Roles;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Roles\UsersRolesGetter;

/**
 * @author Andrea Fiori
 * @since  28 February 2015
 */
class UsersRolesGetterTest extends TestSuite
{
    /**
     * @var UsersRolesGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new UsersRolesGetter($this->getEntityManagerMock());
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

    public function testSetIdWithArrayInput()
    {
        $this->objectGetter->setId(array(1,2,3));

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
}