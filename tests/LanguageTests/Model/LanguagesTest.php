<?php

namespace LanguagesTest\Model;

use Languages\Model\LanguagesSetup;
use SetupTests\TestSuite;

class LanguagesSetupTest extends TestSuite
{
	private $languages;

	protected function setUp()
	{
		parent::setUp();

		$this->languages = new LanguagesSetup($this->serviceManager->get('entityManagerService'));
	}

	public function testSetAllAvailableLanguages()
	{
		$this->assertTrue( is_array($this->languages->setAllAvailableLanguages(1)) );
	}
}