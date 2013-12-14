<?php

namespace ConfigTest\Model;

use Config\Model\Config;
use PHPUnit_Framework_TestCase;

class ConfigTest extends PHPUnit_Framework_TestCase
{
	private $arrayRecordSample;
	
	protected function setUp()
	{
		$this->arrayRecordSample = array(
				'id' => 123,
				'value' => 'My value',
				'isadmin' => 0,
				'module_id' => 1,
				'channel_id' => 1,
				'language_id' => 1
		);
	}
	
	public function testConfigInitialState()
	{
		$this->sayRecordIsNull( new Config() );
	}

	public function testExchangeArraySetsPropertiesCorrectly()
	{
		$config = new Config();
		$config->exchangeArray( $this->arrayRecordSample );

		$this->assertSame($this->arrayRecordSample['id'], $config->id, '"id" was not set correctly');
		$this->assertSame($this->arrayRecordSample['value'], $config->value, '"value" was not set correctly');
		$this->assertSame($this->arrayRecordSample['isadmin'], $config->isadmin, '"isadmin" was not set correctly');
		$this->assertSame($this->arrayRecordSample['module_id'], $config->module_id, '"module_id" was not set correctly');
		$this->assertSame($this->arrayRecordSample['channel_id'], $config->channel_id, '"channel_id" was not set correctly');
		$this->assertSame($this->arrayRecordSample['language_id'], $config->language_id, '"language_id" was not set correctly');
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
	{
		$config = new Config();
		$config->exchangeArray( $this->arrayRecordSample );
		$config->exchangeArray(array());
		
		$this->sayRecordIsNull($config);
	}
	
		private function sayRecordIsNull(Config $config)
		{
			if ( !isset($config->id) ) return false;
			$this->assertNull($config->id, '"id" should have defaulted to null');
			$this->assertNull($config->value, '"value" should have defaulted to null');
			$this->assertNull($config->isadmin, '"isadmin" should have defaulted to null');
			$this->assertNull($config->module_id, '"module_id" should have defaulted to null');
			$this->assertNull($config->channel_id, '"channel_id" should have defaulted to null');
			$this->assertNull($config->language_id, '"language_id" should have defaulted to null');
		}
}