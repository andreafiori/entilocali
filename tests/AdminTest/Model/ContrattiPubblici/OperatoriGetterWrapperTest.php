<?php

namespace AdminTest\Model\ContrattiPubblici;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\ResponsabiliProcedimentoGetter;
use Admin\Model\ContrattiPubblici\ResponsabiliProcedimentoGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ResponsabiliProcedimentoGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ResponsabiliProcedimentoGetterWrapper( new ResponsabiliProcedimentoGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}

