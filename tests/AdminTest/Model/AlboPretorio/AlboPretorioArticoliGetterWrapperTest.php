<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\ArticoliGetter;
use Admin\Model\AlboPretorio\ArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 August 2014
 */
class AlboPretorioGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
  
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ArticoliGetterWrapper( new ArticoliGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
