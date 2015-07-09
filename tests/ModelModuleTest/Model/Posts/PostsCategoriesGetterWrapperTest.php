<?php

namespace ModelModuleTest\Model\Categories;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;

class PostsCategoriesGetterWrapperTest extends TestSuite
{
    /**
     * @var PostsCategoriesGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new PostsCategoriesGetterWrapper(
            new PostsCategoriesGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
