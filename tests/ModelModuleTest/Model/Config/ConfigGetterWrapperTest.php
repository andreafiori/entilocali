<?php

namespace ModelModuleTest\Model\Config;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Config\ConfigGetter;
use ModelModule\Model\Config\ConfigGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  01 November 2014
 */
class ConfigGetterWrapperTest extends TestSuite
{
    /**
     * @var ConfigGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new ConfigGetterWrapper( new ConfigGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
