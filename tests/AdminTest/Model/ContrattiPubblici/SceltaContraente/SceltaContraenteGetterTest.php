<?php

namespace AdminTest\Model\ContrattiPubblici\SceltaContraente;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;

/**
 * @author Andrea Fiori
 * @since  19 August 2014
 */
class ContrattiPubbliciSceltaContraenteGetterTest extends TestSuite
{
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new SceltaContraenteGetter( $this->getEntityManagerMock() );
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
    
    public function testSetNomeScelta()
    {
        $this->objectGetter->setNomeScelta('John Doe');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('nomeScelta'));
    }
}
