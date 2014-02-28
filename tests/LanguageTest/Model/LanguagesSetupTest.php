<?php

namespace LanguagesTest\Model;

use Languages\Model\LanguagesSetup;
use SetupTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  24 February 2014
 */
class LanguagesSetupTest extends TestSuite
{
	private $languagesSetup;

	protected function setUp()
	{
		parent::setUp();

		$this->languagesSetup = new LanguagesSetup($this->getSetupManager());
	}

	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languagesSetup->setAllAvailableLanguages(1)) );
	}
	
	/**
	 * @expectedException \Setup\NullException
	 */
	public function testSetDefaultLanguageLaunchException()
	{
		$this->languagesSetup->setDefaultLanguage('it');
	}
	
	/*
	public function testSetDefaultLanguage()
	{
		$this->languagesSetup->setAllAvailableLanguages(1);
		$this->languagesSetup->setDefaultLanguage('it');
		
		$this->assertEquals('it', $this->languagesSetup->getLanguageAbbreviationFromDefaultLanguage() );
	}
	*/
}