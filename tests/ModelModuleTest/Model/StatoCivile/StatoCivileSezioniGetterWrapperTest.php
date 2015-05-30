<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class StatoCivileSezioniGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}