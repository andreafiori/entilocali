<?php

namespace LanguageTest\Model;

use Language\Model\LanguagesRepository;
use SetupTests\Model\TestSuite;

class LanguageRepositoryTest extends TestSuite
{
	private $languagesRepository;
	
	protected function setUp()
	{
		$this->setUpService();
		
		$this->languagesRepository = new LanguagesRepository($this->serviceManager->get('entityManagerService'));
	}
	
	public function testSetChannelEntity()
	{
		$this->languagesRepository->setChannelEntity(1);
		$this->assertInstanceOf('\Application\Entity\Channels', $this->languagesRepository->getChannelEntity());
		$this->assertEquals($this->languagesRepository->getChannelEntity()->getId(), 1);
	}
	
	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languagesRepository->setAllAvailableLanguages(1)) );
	}
	
	/*
	public function testSetDefaultLanguage()
	{
		$this->assertFalse( $this->languagesRepository->setDefaultLanguage('it') );
		
		$this->languagesRepository->setAllAvailableLanguages(1);
		$this->languagesRepository->setEntitySerializer( new EntitySerializer($this->languagesRepository->getObjectManager()) );
		
		$this->assertTrue( is_object($this->languagesRepository->setDefaultLanguage('it')) );
		$this->assertTrue( is_object($this->languagesRepository->getDefaultLanguage()) );
	}
	*/
}