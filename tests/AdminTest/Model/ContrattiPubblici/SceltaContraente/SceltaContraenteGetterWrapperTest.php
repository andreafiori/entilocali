<?php

namespace AdminTest\Model\ContrattiPubblici\SceltaContraente;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;

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