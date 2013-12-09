<?php
namespace ConfigTest\Model;

use Config\Model\Config;

use PHPUnit_Framework_TestCase;

class ConfigTest extends PHPUnit_Framework_TestCase
{
	public function testConfigInitialState()
	{
		$config = new Config();
		
		$this->assertNull($config->id, '"id" should initially be null');
		$this->assertNull($config->value, '"value" should initially be null');
		$this->assertNull($config->isadmin, '"isadmin" should initially be null');
		$this->assertNull($config->rifmodule, '"rifmodule" should initially be null');
		$this->assertNull($config->rifchannel, '"rifchannel" should initially be null');
		$this->assertNull($config->riflanguage, '"riflanguage" should initially be null');
	}

	public function testExchangeArraySetsPropertiesCorrectly()
	{
		$config = new Config();
		$data  = array( 
				'id' => 123,
				'value' => 'My value',
				'isadmin' => 0,
				'rifmodule' => 1,
				'rifchannel' => 1,
				'riflanguage' => 1
		);

		$config->exchangeArray($data);

		$this->assertSame($data['id'], $config->id, '"title" was not set correctly');
		$this->assertSame($data['value'], $config->value, '"value" was not set correctly');
		$this->assertSame($data['isadmin'], $config->isadmin, '"isadmin" was not set correctly');
		$this->assertSame($data['rifmodule'], $config->rifmodule, '"rifmodule" was not set correctly');
		//$this->assertSame($data['rifchannel'], $config->rifchannel, '"rifchannel" was not set correctly');
		$this->assertSame($data['riflanguage'], $config->riflanguage, '"riflanguage" was not set correctly');
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
	{
		$config = new Config();

		$config->exchangeArray(array(
				'id'     => 123,
				'value'  => 'My value',
				'isadmin' => 0,
				'rifmodule' => 1,
				'rifchannel' => 1,
				'riflanguage' => 1
		));
		$config->exchangeArray(array());
		
		$this->assertNull($config->id, '"id" should have defaulted to null');
		$this->assertNull($config->value, '"value" should have defaulted to null');
		$this->assertNull($config->isadmin, '"isadmin" should have defaulted to null');
		$this->assertNull($config->rifmodule, '"rifmodule" should have defaulted to null');
		$this->assertNull($config->rifchannel, '"rifchannel" should have defaulted to null');
		$this->assertNull($config->riflanguage, '"riflanguage" should have defaulted to null');
	}
}