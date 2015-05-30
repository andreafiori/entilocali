<?php

namespace ModelModuleTest\Model\Categories;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Posts\CategoriesGetter;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class CategoriesGetterTest extends TestSuite
{
    private $objectGetter;

    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new CategoriesGetter( $this->getEntityManagerMock() );
    }

    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetIdPassingStringIsEmpty()
    {
        $this->objectGetter->setId('stringIsNotValid');

        $this->assertEmpty( $this->objectGetter->getQueryBuilder()->getParameter('id') );
    }

    public function testSetIdPassingNumberIsNotEmpty()
    {
        $this->objectGetter->setId(1);

        $this->assertNotEmpty( $this->objectGetter->getQueryBuilder()->getParameter('id') );
    }

    public function testSetIdPassingArrayIsNotEmpty()
    {
        $this->objectGetter->setId(array(1,2,3));

        $this->assertNotEmpty( $this->objectGetter->getQueryBuilder()->getParameter('id') );
    }
    
    public function testSetChannelId()
    {
        $this->objectGetter->setChannelId(1);
        
        $this->assertNotEmpty( $this->objectGetter->getQueryBuilder()->getParameter('channel') );
    }

    public function testSetStatus()
    {
        $this->objectGetter->setStatus('active');
        
        $this->assertNotEmpty( $this->objectGetter->getQueryBuilder()->getParameter('status') );
    }
}