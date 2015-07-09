<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class AlboPretorioSezioniGetterTest extends TestSuite
{
    /**
     * @var AlboPretorioSezioniGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AlboPretorioSezioniGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->objectGetter->setId(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));        
    }
    
    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
}