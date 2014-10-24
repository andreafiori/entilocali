<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class AlboPretorioSezioniGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
