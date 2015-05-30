<?php

namespace ModelModuleTest\Model\Contenuti;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class ContenutiGetterWrapperTest extends TestSuite
{
    /**
     * @var ContenutiGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
