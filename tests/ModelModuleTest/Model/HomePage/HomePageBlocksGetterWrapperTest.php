<?php

namespace ModelModuleTest\Model\HomePage;

use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModuleTest\TestSuite;

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