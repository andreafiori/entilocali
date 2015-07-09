<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModuleTest\TestSuite;

class AlboPretorioArticoliGetterTest extends TestSuite
{
    /**
     * @var AlboPretorioArticoliGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AlboPretorioArticoliGetter($this->getEntityManagerMock());
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue(is_array($this->objectGetter->getQueryResult()), 'The main query does not work correctly');
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
    
    public function testSetNumeroProgressivo()
    {
        $this->objectGetter->setNumeroProgressivo(22);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numeroProgressivo'));
    }
    
    public function testSetNumeroAtto()
    {
        $this->objectGetter->setNumeroAtto(22);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numeroAtto'));
    }
    
    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2014);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));
    }
    
    public function testSetDataScadenza()
    {
        $this->objectGetter->setDataScadenza('20-10-2014');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('dataScadenza'));
    }

    public function testSetFreeSearch()
    {
        $this->objectGetter->setFreeSearch('my search tesxt...');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('freeSearch'));
    }
}
