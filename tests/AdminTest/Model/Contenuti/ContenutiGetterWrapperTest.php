<?php

namespace AdminTest\Model\Contenuti;

use ApplicationTest\TestSuite;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class ContenutiGetterWrapperTest extends TestSuite
{
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
