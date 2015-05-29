<?php

namespace AdminTest\Model\Languages;

use Admin\Model\Languages\LanguagesGetterWrapper;
use ApplicationTest\TestSuite;

class LanguagesGetterWrapperTest extends TestSuite
{
    /**
     * @var LanguagesGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new LanguagesGetterWrapper(
            new LanguagesGetterWrapper($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
