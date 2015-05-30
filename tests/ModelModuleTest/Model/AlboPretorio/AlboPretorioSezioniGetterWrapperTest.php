<?php

namespace ModelModuleTest\Model\EntiTerzi;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;

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
