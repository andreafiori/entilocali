<?php

namespace AdminTest\Model\HomePage;

use Admin\Model\HomePage\HomePageBlocksGetter;
use Admin\Model\HomePage\HomePageBlocksGetterWrapper;
use ApplicationTest\TestSuite;

class HomePageBlocksGetterWrapperTest extends TestSuite
{
    /**
     * @var HomePageBlocksGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new HomePageBlocksGetterWrapper(
            new HomePageBlocksGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}