<?php

namespace ApplicationTest\Setup;

use ApplicationTest\TestSuite;
use Application\Setup\UserInterfaceConfigurations;

/**
 * Help the Common Setup Plugin to set configurations
 * 
 * @author Andrea Fiori
 * @since  30 April 2014
 */
class UserInterfaceConfigurationsTest extends TestSuite
{
    private $backendInput;
    private $frontendInput;
    
    private $isBackend;
    
    protected function setUp()
    {
        parent::setUp();
                
        $this->frontendInput = array(
            "template_frontend"     => "",
            "projectdir_frontend"   => "",
        );
        
        $this->backendInput = array(
            "template_backend" => "",
        );
    }
    
    public function testSetConfigurationsArray()
    {
        $userInterfaceConfigurations = new UserInterfaceConfigurations($this->frontendInput);
        
        $this->assertTrue( is_array($userInterfaceConfigurations->setConfigurationsArray(true)) );
        $this->assertTrue( is_array($userInterfaceConfigurations->setConfigurationsArray($this->isBackend)) );
    }
    
    public function testSetPreloadResponse()
    {
        $this->setupTestSetPreloadResponse( $this->getUserInterfaceConfigurationsInstance(false) );
        $this->setupTestSetPreloadResponse( $this->getUserInterfaceConfigurationsInstance(true) );
    }

        private function setupTestSetPreloadResponse(UserInterfaceConfigurations $userInterfaceConfigurations)
        {
            $userInterfaceConfigurations->setConfigurationsArray($this->isBackend);
            $userInterfaceConfigurations->setPreloadResponse($this->getEntityManagerMock());

            $this->assertTrue( is_array($userInterfaceConfigurations->getConfigurations()) );
        }
    
    public function testSetCommonConfigurations()
    {
        $this->setupTestSetCommonConfigurations( $this->getUserInterfaceConfigurationsInstance(false) );
        $this->setupTestSetCommonConfigurations( $this->getUserInterfaceConfigurationsInstance(true) );
    }

        private function setupTestSetCommonConfigurations(UserInterfaceConfigurations $userInterfaceConfigurations)
        {
            $userInterfaceConfigurations->setConfigurationsArray($this->isBackend);
            $userInterfaceConfigurations->setPreloadResponse($this->getEntityManagerMock());
            $userInterfaceConfigurations->setCommonConfigurations();

            $configurations = $userInterfaceConfigurations->getConfigurations();

            $this->assertArrayHasKey('basiclayout', $configurations);
            $this->assertArrayHasKey('imagedir', $configurations);
            $this->assertArrayHasKey('cssdir', $configurations);
            $this->assertArrayHasKey('jsdir', $configurations);
        }

    /**
     * Setup a UserInterfaceConfigurations instance
     * 
     * @param boolean $isBackend
     * @return \Application\Setup\UserInterfaceConfigurations
     */
    private function getUserInterfaceConfigurationsInstance($isBackend = false)
    {
        if ($isBackend) {
            return new UserInterfaceConfigurations($this->frontendInput);
        } else {
            $this->isBackend = true;
            return new UserInterfaceConfigurations($this->backendInput);
        }
    }
    
}