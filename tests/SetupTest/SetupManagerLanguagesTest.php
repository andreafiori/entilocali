<?php

namespace SetupTest;

use Setup\SetupManagerLanguages;
use Languages\Model\LanguagesSetup;

/**
 * @author Andrea fiori
 * @since  24 January 2014
 */
class SetupManagerLanguagesTest extends TestSuite
{
	private $setupManagerLanguages;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerLanguages = new SetupManagerLanguages();
		$this->setupManagerLanguages->setEntityManager( $this->getEntityManagerMock() );		
		$this->setupManagerLanguages->setLanguagesSetup( new LanguagesSetup($this->getSetupManager()) );
	}
	
	public function testGetLanguagesSetup()
	{
		$this->assertInstanceOf('Languages\Model\LanguagesSetup', $this->setupManagerLanguages->getLanguageSetup());
	}
	
	public function testSetAllAvailableLanguages()
	{
		$this->setupManagerLanguages->setAllAvailableLanguages(1);
		
		$this->assertTrue( is_array($this->setupManagerLanguages->getLanguageSetup()->getAllAvailableLanguages()) );
	}
}