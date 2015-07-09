<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileGetter;

class StatoCivileGetterTest extends TestSuite
{
    /**
     * @var StatoCivileGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new StatoCivileGetter( $this->getEntityManagerMock() );
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
    
    public function testSetProgressivo()
    {
        $this->objectGetter->setProgressivo(123);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numero_progressivo'));
    }
    
    public function testSetProgressivoWithArrayInInput()
    {
        $this->objectGetter->setProgressivo( array(1,2,3) );
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numero_progressivo'));
    }
    
    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2014);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));
    }
    
    public function testSetScadenza()
    {
        $this->assertInstanceOf('\Doctrine\ORM\QueryBuilder', $this->objectGetter->setScadenza('2030-01-01 02:00'));
    }
    
    public function testSetSezioneId()
    {
        $this->objectGetter->setSezioneId(11);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sezioneId'));
    }
    
    public function testSetTextSearch()
    {
        $this->objectGetter->setTextSearch('textToSearch');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('textSearch'));
    }
}