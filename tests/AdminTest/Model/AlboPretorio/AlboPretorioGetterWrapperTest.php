<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioGetter;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 August 2014
 */
class AlboPretorioGetterWrapperTest extends TestSuite
{
    private $alboPretorioGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->alboPretorioGetterWrapper->setupQueryBuilder() );
    }
}
