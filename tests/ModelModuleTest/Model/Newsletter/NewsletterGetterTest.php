<?php

namespace ModelModuleTest\Model\Newsletter;

use ModelModule\Model\Newsletter\NewsletterGetter;
use ModelModuleTest\TestSuite;

class NewsletterGetterTest extends TestSuite
{
    /**
     * @var NewsletterGetter
     */
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->objectGetter = new NewsletterGetter($this->getEntityManagerMock());
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

    public function testSetSent()
    {
        $this->objectGetter->setSent(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sent'));
    }
}
