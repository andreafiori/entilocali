<?php

namespace ModelModuleTest\Model\EntiTerzi;

use ModelModuleTest\TestSuite;
use ModelModule\Model\EntiTerzi\EntiTerziGetter;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class EntiTerziGetterTest extends TestSuite
{
    /**
     * @var EntiTerziGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new EntiTerziGetter($this->getEntityManagerMock());
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
}
