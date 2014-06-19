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
    
    public function testSetId()
    {
        $this->categoriesGetter->setId('stringIsNotValid');
        $this->assertEmpty( $this->categoriesGetter->getQueryBuilder()->getParameter('id') );
        
        $this->categoriesGetter->setId(1);
        $this->assertNotEmpty( $this->categoriesGetter->getQueryBuilder()->getParameter('id') );
        
        $this->categoriesGetter->setId(array(1,2,3));
        $this->assertNotEmpty( $this->categoriesGetter->getQueryBuilder()->getParameter('id') );
    }
    
    public function testSetChannelId()
    {
        $this->categoriesGetter->setChannelId(1);
        
        $this->assertNotEmpty( $this->categoriesGetter->getQueryBuilder()->getParameter('channel') );
    }
}