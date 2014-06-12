<?php

namespace ApplicationTest\Model\Categories;

use ApplicationTest\TestSuite;
use Admin\Model\Categories\CategoriesGetter;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class CategoriesGetterTest extends TestSuite
{
    private $categoriesGetter;

    protected function setUp()
    {
        parent::setUp();
        
        $this->categoriesGetter = new CategoriesGetter( $this->getEntityManagerMock() );
    }

    public function testSetMainQuery()
    {
        $this->categoriesGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->categoriesGetter->getQueryResult()) );
    }
}