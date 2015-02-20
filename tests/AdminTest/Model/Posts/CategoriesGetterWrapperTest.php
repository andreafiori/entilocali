<?php

namespace AdminTest\Model\Categories;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\CategoriesGetter;
use Admin\Model\Posts\CategoriesGetterWrapper;

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
