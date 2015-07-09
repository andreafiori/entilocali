<?php

namespace ModelModuleTest\Model\Sezioni;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Sezioni\SezioniGetter;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniGetterTest extends TestSuite
{
    /**
     * @var SezioniGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new SezioniGetter( $this->getEntityManagerMock() );
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
    
    public function testSetColonna()
    {
        $this->objectGetter->setColonna('sx');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('colonna'));
    }
    
    public function testSetAttivo()
    {
        $this->objectGetter->setAttivo(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('attivo'));
    }

    public function testSetBlocco()
    {
        $this->objectGetter->setBlocco(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('blocco'));
    }

    public function testSetLingua()
    {
        $this->objectGetter->setLingua('it');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('lingua'));
    }
}