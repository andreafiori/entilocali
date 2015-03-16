<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class StatoCivileSezioniGetterTest extends TestSuite
{
    /**
     * @var StatoCivileSezioniGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new StatoCivileSezioniGetter( $this->getEntityManagerMock() );
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
    
    public function testSetIdWithArrayParameter()
    {
        $this->objectGetter->setId(array(1,2,3));
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
}