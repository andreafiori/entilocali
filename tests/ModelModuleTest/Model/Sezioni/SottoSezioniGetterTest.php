<?php

namespace ModelModuleTest\Model\Sezioni;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Sezioni\SottoSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SottoSezioniGetterTest extends TestSuite
{
    /**
     * @var SottoSezioniGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new SottoSezioniGetter( $this->getEntityManagerMock() );
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

    public function testSetExcludeId()
    {
        $this->objectGetter->setExcludeId(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeId'));
    }

    public function testSetExcludeIdWithArrayInput()
    {
        $this->objectGetter->setExcludeId(array(1,2,3));

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('excludeId'));
    }
    
    public function testSetIsSs()
    {
        $this->objectGetter->setIsSs(1);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('isSs'));
    }
    
    public function testSetProfonditaDa()
    {
        $this->objectGetter->setProfonditaDa(21);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('profonditaDa'));
    }
}