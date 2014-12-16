<?php

namespace Admin\Model\AttiConcessioneTest;

use ApplicationTest\TestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneRespProcGetter;
use Admin\Model\AttiConcessione\AttiConcessioneRespProcGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneRespProcGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttiConcessioneRespProcGetterWrapper( new AttiConcessioneRespProcGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
