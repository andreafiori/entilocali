<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManagerConfigurations;
use Config\Model\ConfigQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  25 February 2014
 */
class SetupManagerConfigurationsTest extends TestSuite
{
	private $setupManagerConfigurations;
	
	protected function setUp()
	{
		parent::setUp();
		
		$configQueryBuilder = new ConfigQueryBuilder();
		$configQueryBuilder->setSetupManager($this->getSetupManager());
		
		$this->setupManagerConfigurations = new SetupManagerConfigurations();
		$this->setupManagerConfigurations->setConfigQueryBuilder($configQueryBuilder);
	}
	
	public function testSetConfigurations()
	{
		$this->setupManagerConfigurations->setConfigurations( array("isbackend" => 0, "channelId" => array(1, 0)) );
		
		$this->assertTrue( is_array($this->setupManagerConfigurations->getConfigurations()) );
	}
}