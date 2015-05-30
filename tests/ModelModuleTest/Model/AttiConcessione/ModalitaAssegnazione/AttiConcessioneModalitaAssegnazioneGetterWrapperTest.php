<?php

namespace ModelModuleTest\Model\AttiConcessione\ModalitaAssegnazione;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class AttiConcessioneModalitaAssegnazioneGetterWrapperTest extends TestSuite
{
    /**
     * @var AttiConcessioneModalitaAssegnazioneGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new AttiConcessioneModalitaAssegnazioneGetterWrapper(
            new AttiConcessioneModalitaAssegnazioneGetter($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}