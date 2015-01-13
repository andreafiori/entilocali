<?php

namespace AdminTest\Model\Contenuti;

use ApplicationTest\TestSuite;
use Admin\Model\Contenuti\ContenutiGetter;

/**
 * @author Andrea Fiori
 * @since  11 January 2015
 */
class ContenutiGetterTest extends TestSuite
{
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new ContenutiGetter( $this->getEntityManagerMock() );
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
    
    public function testSetSottosezione()
    {
        $this->objectGetter->setSottosezione(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sottosezione'));        
    }
    
    public function testSetSottosezioneWithArrayInInput()
    {
        $this->objectGetter->setSottosezione( array(1,2,3) );

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('sottosezione'));
    }
    
    public function testSetNumero()
    {
        $this->objectGetter->setNumero(132);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('numero'));        
    }
    
    public function testSetAnno()
    {
        $this->objectGetter->setAnno(2015);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('anno'));        
    }
    
    public function testSetDataScadenza()
    {
        $this->objectGetter->setDataScadenza(2015);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('scadenza'));        
    }
}