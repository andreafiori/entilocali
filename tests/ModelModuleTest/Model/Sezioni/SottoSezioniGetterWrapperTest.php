<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SottoSezioniGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}