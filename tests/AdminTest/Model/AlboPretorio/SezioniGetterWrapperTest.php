<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\SezioniGetter;
use Admin\Model\AlboPretorio\SezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class SezioniGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new SezioniGetterWrapper( new SezioniGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
