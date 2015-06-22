<?php

namespace ModelModuleTest\Model\Newsletter;

use ModelModule\Model\Newsletter\NewsletterGetter;
use ModelModule\Model\Newsletter\NewsletterGetterWrapper;
use ModelModuleTest\TestSuite;

class NewsletterGetterWrapperTest extends TestSuite
{
    /**
     * @var NewsletterGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new NewsletterGetterWrapper( new NewsletterGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
