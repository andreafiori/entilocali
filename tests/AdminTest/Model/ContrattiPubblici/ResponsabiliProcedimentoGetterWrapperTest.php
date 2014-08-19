<?php

namespace AdminTest\Model\ContrattiPubblici;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\OperatoriGetter;
use Admin\Model\ContrattiPubblici\OperatoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  19 August 2014
 */
class ContrattiPubbliciOperatoriGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new OperatoriGetterWrapper( new OperatoriGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
