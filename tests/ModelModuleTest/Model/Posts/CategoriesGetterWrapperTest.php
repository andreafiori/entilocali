<?php

namespace ModelModuleTest\Model\Categories;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Posts\CategoriesGetter;
use ModelModule\Model\Posts\CategoriesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class CategoriesGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new CategoriesGetterWrapper( new CategoriesGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
