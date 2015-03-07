<?php

namespace AdminTest\Model\ContrattiPubblici;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\Settori\SettoriGetter;
use Admin\Model\ContrattiPubblici\Settori\SettoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ContrattiPubbliciSettoriGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new SettoriGetterWrapper( new SettoriGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}