<?php

namespace LanguageTest\Model;

use Language\Model\LanguagesRepository;
use SetupTests\TestSuite;

class LanguagesTest extends TestSuite
{
	private $languages;

	protected function setUp()
	{
		parent::setUp();

		$this->languages = new LanguagesRepository($this->serviceManager->get('entityManagerService'));
	}
	
	/**
	 * @test
	 */
	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languages->setAllAvailableLanguages(1)) );
	}
}