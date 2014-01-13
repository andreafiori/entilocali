<?php

namespace SetupTest;

use Setup\SetupManagerLanguages;
use Languages\Model\LanguagesSetup;

class SetupManagerLanguagesTest extends TestSuite {

	private $setupManagerLanguages;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerLanguages = new SetupManagerLanguages();
		$this->setupManagerLanguages->setEntityManager($this->getEntityManagerMock());
	}

	protected function tearDown()
	{
		parent::tearDown();
		
		unset($this->setupManagerLanguages);
	}

	public function testSetLanguageIdFromDefaultLanguage()
	{
		$this->setupManagerLanguages->setLanguagesSetup( new LanguagesSetup($this->getDoctrineEntityManager()) );
		$this->setupManagerLanguages->getLanguageSetup()->setAllAvailableLanguages($this->setupManagerLanguages->getInput('channel'));
		$this->setupManagerLanguages->setDefaultLanguage();
		
		$this->assertEquals($this->setupManagerLanguages->setLanguageIdFromDefaultLanguage(), 1);
	}
	
	public function testSetLanguagesSetup()
	{
		$this->setupManagerLanguages->setLanguagesSetup( new LanguagesSetup($this->getDoctrineEntityManager()) );

		$this->assertTrue( $this->setupManagerLanguages->getLanguageSetup() instanceof LanguagesSetup );
	}
	
}