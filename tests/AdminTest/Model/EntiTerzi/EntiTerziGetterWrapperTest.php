<?php

namespace AdminTest\Model\EntiTerzi;

use ApplicationTest\TestSuite;
use Admin\Model\Entiterzi\EntiTerziGetter;
use Admin\Model\EntiTerzi\EntiTerziGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziGetterWrapperTest extends TestSuite
{
    /**
     * @var EntiTerziGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
