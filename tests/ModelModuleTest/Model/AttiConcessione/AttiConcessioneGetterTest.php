<?php

namespace ModelModuleTest\Model\AttiConcessione;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;

class AttiConcessioneGetterTest extends TestSuite
{
    /**
     * @var AttiConcessioneGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AttiConcessioneGetter( $this->getEntityManagerMock() );
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

    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2015);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));
    }

    public function testSetAttivo()
    {
        $this->objectGetter->setAttivo(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('attivo'));
    }

    public function testSetBeneficiarioSearch()
    {
        $this->objectGetter->setBeneficiarioSearch('myBeneficiario');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('beneficiarioSearch'));
    }

    public function testSetImporto()
    {
        $this->objectGetter->setImporto(2040);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('importo'));
    }

    public function testSetProgressivo()
    {
        $this->objectGetter->setProgressivo(12);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('progressivo'));
    }

    public function testSetSettoreId()
    {
        $this->objectGetter->setSettoreId(12);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('settoreId'));
    }
}