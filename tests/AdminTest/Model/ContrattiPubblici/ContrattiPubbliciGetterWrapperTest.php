<?php

namespace AdminTest\Model\ContrattiPubblici;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContrattiPubbliciGetterWrapperTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}