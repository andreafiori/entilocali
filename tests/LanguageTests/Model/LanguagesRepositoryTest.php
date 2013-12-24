<?php

namespace LanguageTest\Model;

use Language\Model\LanguagesRepository;
use SetupTests\Model\TestSuite;

class LanguagesRepositoryTest extends TestSuite
{
	private $languagesRepository;
		
	private $channelEntity;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setChannelEntity(1);
		$this->languagesRepository = new LanguagesRepository($this->serviceManager->get('entityManagerService'));
	}
	
	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languagesRepository->setAllAvailableLanguages($this->channelEntity)) );
	}
	
		/**
		 * 
		 * @param number $channel
		 */
		private function setChannelEntity($channel=1)
		{
			$this->channelEntity = new \Application\Entity\Channels();
			$this->channelEntity->setId($channel);
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