<?php

namespace ModelModuleTest\Model\Atticoncessione;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  23 March 2015
 */
class AttiConcessioneGetterWrapperTest extends TestSuite
{
    /**
     * @var AttiConcessioneGetterWrapper
     */
    private $objectWrapper;

    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttiConcessioneGetterWrapper(
            new AttiConcessioneGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
