<?php

namespace AdminTest\Model\Users\Todo;

use ApplicationTest\TestSuite;
use Admin\Model\Users\Todo\UsersTodoGetter;

/**
 * @author Andrea Fiori
 * @since  29 March 2015
 */
class UsersTodoGetterTest extends TestSuite
{
    /**
     * @var UsersTodoGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new UsersTodoGetter( $this->getEntityManagerMock() );
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
}