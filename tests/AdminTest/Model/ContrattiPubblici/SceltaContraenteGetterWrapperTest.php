<?php

namespace AdminTest\Model\ContrattiPubblici;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\SceltaContraenteGetter;
use Admin\Model\ContrattiPubblici\SceltaContraenteGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContrattiPubbliciSceltaContraenteGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new SceltaContraenteGetterWrapper( new SceltaContraenteGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}