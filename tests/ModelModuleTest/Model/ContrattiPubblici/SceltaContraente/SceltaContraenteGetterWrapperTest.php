<?php

namespace ModelModuleTest\Model\ContrattiPubblici\SceltaContraente;

use ModelModuleTest\TestSuite;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContrattiPubbliciSceltaContraenteGetterWrapperTest extends TestSuite
{
    /**
     * @var SceltaContraenteGetterWrapper
     */
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