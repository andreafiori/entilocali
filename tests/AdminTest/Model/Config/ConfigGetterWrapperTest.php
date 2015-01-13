<?php

namespace AdminTest\Model\Config;

use ApplicationTest\TestSuite;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  01 November 2014
 */
class ConfigGetterWrapperTest extends TestSuite
{
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
