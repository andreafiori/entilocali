<?php

namespace AdminTest\Model\AttiConcessione\ModalitaAssegnazione;

use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;

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