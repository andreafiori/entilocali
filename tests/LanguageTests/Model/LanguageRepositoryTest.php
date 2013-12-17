<?php

namespace ConfigTest\Model;

use Language\Model\LanguageRepository;
use SetupTests\Model\TestSuite;

class LanguageRepositoryTest extends TestSuite
{
	private $languagesRepository;
	
	protected function setUp()
	{
		$this->setUpService();
		
		$objectManager = $this->serviceManager->get('entityManagerService');
		$this->languagesRepository = new LanguageRepository($objectManager);
	}
	
	/** @test */
	public function getRecord()
	{
		$objLang = $this->languagesRepository->GetRecord();
		$this->assertEquals($objLang->getId(), 1);
	}
	
	/** @test */
	public function getRecordFromLanguageAbbreviation()
	{
		$objLang = $this->languagesRepository->GetRecordFromLanguageAbbreviation('it');
		$this->assertEquals($objLang->getAbbrev1(), 'it');
	}
}