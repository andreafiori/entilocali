<?php

namespace AdminTest\Service;

use Admin\Service\PluginManager;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  25 November 2013
 */
class PluginManagerTest extends TestSuite
{
    private $pluginManager;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->pluginManager = new PluginManager();
    }
    
    public function testValidatePlugin()
    {
        $this->assertNull( $this->pluginManager->validatePlugin( new \Admin\Service\AppServiceLoader(array('test')) ) );
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidatePluginThrowsException()
    {
        $this->pluginManager->validatePlugin('Application\Service\NotAPluginInterface');
    }
}