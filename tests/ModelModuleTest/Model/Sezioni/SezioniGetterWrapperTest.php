<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new SezioniGetterWrapper( new SezioniGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}