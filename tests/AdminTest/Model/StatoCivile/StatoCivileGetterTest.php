<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileGetter;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class StatoCivileGetterTest extends TestSuite
{
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
}