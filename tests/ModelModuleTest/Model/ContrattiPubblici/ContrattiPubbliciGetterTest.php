<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciGetterTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new ContrattiPubbliciGetter( $this->getEntityManagerMock() );
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

    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2015);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));
    }

    public function testSetImporto()
    {
        $this->objectGetter->setImporto(1230);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('importo'));
    }

    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetUserId()
    {
        $this->objectGetter->setUserId(11);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('userId'));
    }

    public function testSetFreeSearch()
    {
        $this->objectGetter->setFreeSearch('my free text search test');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('freeSearch'));
    }

    /*
    public function testSetNoScaduti()
    {
       $this->objectGetter->setNoScaduti(1);
    }

    public function testSetScaduti()
    {
       $this->objectGetter->setNoScaduti(1);
    }
    */
}