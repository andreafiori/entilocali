<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModuleTest\TestSuite;

class HomePageBlocksGetterTest extends TestSuite
{
    /**
     * @var HomePageBlocksGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new HomePageBlocksGetter($this->getEntityManagerMock());
    }

    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();

        $this->assertTrue(is_array($this->objectGetter->getQueryResult()));
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