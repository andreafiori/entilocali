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
				'rifmodule' => 1,
				'rifchannel' => 1,
				'riflanguage' => 1
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
		$this->assertSame($this->arrayRecordSample['rifmodule'], $config->rifmodule, '"rifmodule" was not set correctly');
		$this->assertSame($this->arrayRecordSample['rifchannel'], $config->rifchannel, '"rifchannel" was not set correctly');
		$this->assertSame($this->arrayRecordSample['riflanguage'], $config->riflanguage, '"riflanguage" was not set correctly');
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
			$this->assertNull($config->rifmodule, '"rifmodule" should have defaulted to null');
			$this->assertNull($config->rifchannel, '"rifchannel" should have defaulted to null');
			$this->assertNull($config->riflanguage, '"riflanguage" should have defaulted to null');
		}
}