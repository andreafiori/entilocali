<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AmministrazioneTrasparenteGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AmministrazioneTrasparenteGetterWrapper( new AmministrazioneTrasparenteGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
