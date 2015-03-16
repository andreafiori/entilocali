<?php

namespace AdminTest\Model\ContrattiPubblici\ResponsabiliProcedimento;

use ApplicationTest\TestSuite;
use Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoGetter;
use Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class ResponsabiliProcedimentoGetterWrapperTest extends TestSuite
{
    /**
     * @var ResponsabiliProcedimentoGetterWrapper
     */
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

