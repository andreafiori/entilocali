<?php

namespace AdminTest\Model\AttiConcessione;

use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
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
}