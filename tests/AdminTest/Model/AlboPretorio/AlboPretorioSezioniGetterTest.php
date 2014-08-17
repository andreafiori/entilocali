<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class AlboPretorioSezioniGetterTest extends TestSuite
{
    private $alboPretorioSezioniGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioSezioniGetter = new AlboPretorioSezioniGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->alboPretorioSezioniGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->alboPretorioSezioniGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->alboPretorioSezioniGetter->setId(1);
        
        $this->assertNotEmpty($this->alboPretorioSezioniGetter->getQueryBuilder()->getParameter('id'));        
    }
    
    public function testSetIdWithArrayInInput()
    {
        $this->alboPretorioSezioniGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->alboPretorioSezioniGetter->getQueryBuilder()->getParameter('id'));
    }
}