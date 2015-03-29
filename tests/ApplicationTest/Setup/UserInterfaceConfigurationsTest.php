<?php

namespace ApplicationTest\Setup;

use ApplicationTest\TestSuite;
use Application\Setup\UserInterfaceConfigurations;

/**
 * @author Andrea Fiori
 * @since  30 April 2014
 */
class UserInterfaceConfigurationsTest extends TestSuite
{
    private $backendInput;

    private $frontendInput;
    
    protected function setUp()
    {
        parent::setUp();
                
        $this->frontendInput = array(
            "template_frontend"     => "myTemplate/",
            "projectdir_frontend"   => "myProject/",
        );
        
        $this->backendInput = array(
            "template_backend"      => "myTemplate/",
            "projectdir_backtend"   => "myProject/",
        );
    }
    
    public function testSetConfigurations()
    {
        $userInterfaceConfigurations = new UserInterfaceConfigurations($this->frontendInput);
        
        $this->assertTrue( is_array($userInterfaceConfigurations->getConfigurations()) );
    }

    public function testSetAdditionalFrontendConfigurationsArray()
    {
        $userInterfaceConfigurations = new UserInterfaceConfigurations($this->frontendInput);

        $this->assertTrue( is_array($userInterfaceConfigurations->setAdditionalFrontendConfigurationsArray()) );
    }

    public function testSetAdditionalBackendConfigurationsArray()
    {
        $userInterfaceConfigurations = new UserInterfaceConfigurations($this->backendInput);

        $this->assertTrue( is_array($userInterfaceConfigurations->setAdditionalAdminConfigurationsArray()) );
    }

    public function testSetPreloadResponse()
    {
        $userInterfaceConfigurations = new UserInterfaceConfigurations($this->backendInput);

        $this->assertTrue( is_array($userInterfaceConfigurations->setPreloadResponse($this->getEntityManagerMock())) );
    }
}