<?php

namespace AdminTest\Model\ContrattiPubblici\ResponsabiliProcedimento;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use Admin\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

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
