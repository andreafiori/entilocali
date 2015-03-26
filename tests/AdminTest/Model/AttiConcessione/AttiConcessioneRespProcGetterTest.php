<?php

namespace AdminTest\Model\AttiConcessione;

use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneRespProcGetter;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneRespProcGetterTest extends TestSuite
{
    /**
     * @var AttiConcessioneRespProcGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AttiConcessioneRespProcGetter( $this->getEntityManagerMock() );
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