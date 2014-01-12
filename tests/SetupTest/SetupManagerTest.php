<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\SetupManager;
use ServiceLocatorFactory;
use ApplicationTest\ServiceManagerGrabber;
use Config\Model\ConfigRepository;
use Languages\Model\LanguagesSetup;
use Languages\Model\LanguagesLabelsRepository;

class SetupManagerTest extends TestSuite
{
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager(
				array('channel' => 1,'isbackend' => 0)
		);
		
		$this->setupManager->setEntityManager($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
	}
	
	public function testgetInput()
	{
		$input = $this->setupManager->getInput();
		
		$this->assertArrayHasKey('channel', $input);
	}
	
	public function testSetEntityManager()
	{
		$this->assertNotEmpty( ServiceManagerGrabber::getServiceConfig() );
	}
	
	public function testSetChannelId()
	{
		$this->setupManager->setChannelId();
		$this->assertEquals($this->setupManager->getChannelId(), 1);
	}
	
	public function testSetConfigRepository()
	{
		$this->setupManager->getSetupManagerConfigurations()->setConfigRepository( $this->getConfigRepository() );
		$this->assertTrue( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository() instanceof ConfigRepository);
	}
	
	/*
	 * TODO: this test is a mess!!!
	public function testSetLanguageIdFromDefaultLanguage()
	{
		$this->setupManager->setLanguagesSetup( new LanguagesSetup($this->setupManager->getEntityManager()) );
		$this->setupManager->getLanguageSetup()->setAllAvailableLanguages($this->setupManager->getInput('channel'));
		$this->setupManager->setDefaultLanguage();

		$this->assertEquals($this->setupManager->setLanguageIdFromDefaultLanguage(), 1);
	}
	*/

	public function testSetLanguagesLabelsRepository()
	{
		$this->assertTrue($this->setupManager->getSetupManagerLanguages()->setLanguagesLabelsRepository( new LanguagesLabelsRepository($this->setupManager->getEntityManager()) ) instanceof LanguagesLabelsRepository);
	}

	/**
	 * @expectedException \Setup\NullException
	 */
	public function testSetConfigurationsLaunchException()
	{
		$this->assertFalse($this->setupManager->getSetupManagerConfigurations()->setConfigurations());
		
		$this->setupManager->setConfigRepository( $this->getConfigRepository() );
	}
		
		private function getConfigRepository()
		{
			return new ConfigRepository($this->getServiceManager()->get('\Doctrine\ORM\EntityManager'));
		}
}