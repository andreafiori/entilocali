<?php

namespace ModelModuleTest\Model\Languages;

use ModelModule\Model\Languages\LanguagesGetter;
use ModelModuleTest\TestSuite;

class LanguagesGetterTest extends TestSuite
{
    /**
     * @var LanguagesGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new LanguagesGetter($this->getEntityManagerMock());
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
