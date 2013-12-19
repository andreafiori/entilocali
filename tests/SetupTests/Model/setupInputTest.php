<?php

use SetupTests\Model\TestSuite;

class setupInput {
	
	private $channelId, $languageAbbreviation;
	
	public function setChannelId($id = 1)
	{
		$this->channelId = $id;
		return $this->channelId;
	}
	
	public function setLanguageAbbreviation($languageAbbreviation)
	{
		if (!$languageAbbreviation) return false;
		$this->languageAbbreviation = $languageAbbreviation;
		return $languageAbbreviation;
	}
	
	public function getChannelId()
	{
		return $this->channelId;
	}

	public function getLanguageAbbreviation()
	{
		return $this->languageAbbreviation;
	}
}

/**
 * set the input to manage on setup 
 * @author Andrea Fiori
 * 
 */
class setupInputTest extends TestSuite {
	
	private $setupInput;
	
	protected function setUp()
	{
		$this->setUpService();
		
		$this->setupInput = new setupInput();
	}
	
	public function testSetChannelId()
	{
		$this->assertEquals($this->setupInput->setChannelId(2), $this->setupInput->getChannelId());
		$this->assertEquals($this->setupInput->setChannelId(), $this->setupInput->getChannelId());
	}
	
	public function testSetLanguageAbbreviation()
	{
		$this->assertEquals($this->setupInput->setLanguageAbbreviation('it'), $this->setupInput->getLanguageAbbreviation());
		$this->assertFalse($this->setupInput->setLanguageAbbreviation(null));
	}
}