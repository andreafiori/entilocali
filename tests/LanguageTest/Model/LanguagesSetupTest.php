<?php

namespace LanguagesTest\Model;

use Languages\Model\LanguagesSetup;
use SetupTest\TestSuite;

class LanguagesSetupTest extends TestSuite
{
	private $languagesSetup;

	protected function setUp()
	{
		parent::setUp();

		$this->languagesSetup = new LanguagesSetup($this->serviceManager->get('entityManagerService'));
	}

	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languagesSetup->setAllAvailableLanguages(1)) );
	}
	
	/**
	 * @expectedException \Setup\NullException 
	 */
	public function testSetDefaultLanguageLaunchExceptionAllLanguagesIsNotSet()
	{
		$this->languagesSetup->setDefaultLanguage('it');
	}
	
	public function testSetDefaultLanguage()
	{
		$this->languagesSetup->setAllAvailableLanguages(1);
		$this->languagesSetup->setDefaultLanguage('it');
		
		$this->assertTrue( is_array($this->languagesSetup->getDefaultLanguage()) );
		$this->assertEquals('it', $this->languagesSetup->getLanguageAbbreviationFromDefaultLanguage() );
	}
}