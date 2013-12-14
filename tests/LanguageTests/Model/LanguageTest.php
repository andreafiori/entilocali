<?php

namespace LanguageTest\Model;

use PHPUnit_Framework_TestCase;
use ApplicationTests\ServiceManagerGrabber;
use Language\Model\Language;

class LanguageTest extends PHPUnit_Framework_TestCase
{
	private $arrayRecordSample, $serviceManager;

	protected function setUp()
	{
		$this->arrayRecordSample = array(
				'id' => 123,
				'language' => 'English',
				'abbrev1' => 'en',
				'abbrev2' => 'eng',
				'abbrev3' => 'english',
				/*
				'defaultlang' => 1,
				'defaultlang_admin' => 1,
				'encoding' => 'UTF-8',
				'flag' => 'eng.gif',
				'active' => 1,
				'channel_id' => 1
				*/
		);
		
		$serviceManagerGrabber   = new ServiceManagerGrabber();
		$this->serviceManager = $serviceManagerGrabber->getServiceManager();
	}

	public function testLanguageInitialState()
	{
		$language = new Language();
		$language->id = null;
		$this->sayRecordIsNull($language);
	}

	public function testExchangeArraySetsPropertiesCorrectly()
	{
		$language = new Language();
		$language->exchangeArray( $this->arrayRecordSample );

		$this->assertSame($this->arrayRecordSample['id'], $language->id, '"id" was not set correctly');
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
	{
		$language = new Language();
		$language->exchangeArray( $this->arrayRecordSample );
		$language->exchangeArray(array());
		
		$this->sayRecordIsNull($language);
	}
	
		private function sayRecordIsNull(Language $language)
		{
			$this->assertNull($language->id, '"id" should have defaulted to null');
		}
}