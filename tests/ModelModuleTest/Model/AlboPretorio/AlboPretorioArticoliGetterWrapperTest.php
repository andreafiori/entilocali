<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

class AlboPretorioGetterWrapperTest extends TestSuite
{
    /**
     * @var AlboPretorioArticoliGetterWrapper
     */
    private $objectWrapper;
  
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AlboPretorioArticoliGetterWrapper(
            new AlboPretorioArticoliGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
