<?php

namespace AdminTest\Model\Atticoncessione;

use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttiConcessioneGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttiConcessioneGetterWrapper( new AttiConcessioneGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
