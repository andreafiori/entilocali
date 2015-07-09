<?php

namespace ModelModuleTest\Model\ContrattiPubblici\ResponsabiliProcedimento;

use ModelModuleTest\TestSuite;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  19 August 2014
 */
class ContrattiPubbliciOperatoriGetterWrapperTest extends TestSuite
{
    /**
     * @var OperatoriGetterWrapper
     */
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
