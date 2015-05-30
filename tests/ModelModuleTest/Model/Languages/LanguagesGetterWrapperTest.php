<?php

namespace ModelModuleTest\Model\Languages;

use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModuleTest\TestSuite;

class LanguagesGetterWrapperTest extends TestSuite
{
    /**
     * @var LanguagesGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new LanguagesGetterWrapper( new LanguagesGetter($this->getEntityManagerMock()) );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
