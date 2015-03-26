<?php

namespace AdminTest\Model\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneSettoriGetterWrapper;
use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneSettoriGetter;

/**
 * @author Andrea Fiori
 * @since  23 March 2015
 */
class AttiConcessioneSettoriGetterWrapperTest extends TestSuite
{
    /**
     * @var AttiConcessioneSettoriGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttiConcessioneSettoriGetterWrapper(
            new AttiConcessioneSettoriGetter($this->getEntityManagerMock())
        );
    }

    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}