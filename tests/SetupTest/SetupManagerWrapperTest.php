<?php

namespace SetupTest;

use Setup\SetupManagerWrapper;
use Setup\SetupManagerLanguages;
use Setup\SetupManagerLanguagesLabels;
use Setup\SetupManagerConfigurations;

/**
 * 
 * @author Andrea Fiori
 * @since  24 January 2014
 */
class SetupManagerWrapperTest extends TestSuite
{
	private $setupManagerWrapper;

	protected function setUp()
	{
		parent::setUp();

		$setupManager = $this->getSetupManager();
		
		$this->setupManagerWrapper = new SetupManagerWrapper( $this->getSetupManager() );
		$this->setupManagerWrapper->setupEntityManager( $setupManager->getEntityManager() );
	}
	
	public function testDetectChannel()
	{
		$this->setupManagerWrapper->detectChannel();
		
		$this->assertEquals($this->getSetupManagerFromWrapper()->getChannelId(), 1);
	}

	public function testSetupLanguages()
	{
		$this->setupManagerWrapper->setupLanguages();
		
		$this->assertTrue( $this->getSetupManagerFromWrapper()->getSetupManagerLanguages() instanceof SetupManagerLanguages);
	}

	public function testSetupLanguageLabels()
	{
		$this->setupManagerWrapper->setupLanguages();
		$this->setupManagerWrapper->setupLanguagesLabels();
		
		$this->assertTrue( $this->getSetupManagerFromWrapper()->getSetupManagerLanguagesLabels() instanceof SetupManagerLanguagesLabels);		
	}
	
	public function testSetupConfigurations()
	{
		$this->setupManagerWrapper->setupConfigurations();
		
		$this->assertTrue( $this->getSetupManagerFromWrapper()->getSetupManagerConfigurations() instanceof SetupManagerConfigurations);		
	}
	
		private function getSetupManagerFromWrapper()
		{
			return $this->setupManagerWrapper->getSetupManager();
		}
}