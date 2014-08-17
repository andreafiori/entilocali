<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioGetter;

/**
 * @author Andrea Fiori
 * @since  15 August 2014
 */
class AlboPretorioGetterTest extends TestSuite
{
    private $alboPretorioGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioGetter = new AlboPretorioGetter($this->getEntityManagerMock());
    }
    
    public function testSetMainQuery()
    {
        $this->alboPretorioGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->alboPretorioGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->alboPretorioGetter->setId(1);
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetIdWithArrayInInput()
    {
        $this->alboPretorioGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetNumeroProgressivo()
    {
        $this->alboPretorioGetter->setNumeroProgressivo(22);
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('numeroProgressivo'));
    }
    
    public function testSetNumeroAtto()
    {
        $this->alboPretorioGetter->setNumeroAtto(22);
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('numeroAtto'));
    }
    
    public function testSetAnno()
    {
        $this->alboPretorioGetter->setAnno(2014);
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('anno'));
    }
    
    public function testSetDataScadenza()
    {
        $this->alboPretorioGetter->setDataScadenza('20-10-2014');
        
        $this->assertNotEmpty($this->alboPretorioGetter->getQueryBuilder()->getParameter('dataScadenza'));
    }
}
