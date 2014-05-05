<?php

namespace ApplicationTest\Setup;

use ApplicationTest\TestSuite;
use Application\Setup\ConfigSetup;

/**
 * 
 * @author Andrea Fiori
 * @since 26 April 2014
 */
class ConfigSetupTest extends TestSuite
{
    private $configSetup;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->configSetup = new ConfigSetup( $this->getQueryBuilderMock() );
    }
    
    public function testSetConfigurations()
    {
        $this->assertTrue( is_array($this->configSetup->setConfigurations()) );
    }
}