<?php

namespace Setup\Model;

use Application\Entity\Channels;

class SetupEntitySetter {
	
	private $channel;
	
	private $languages, $languagesLabels;
	
	private $config;
	
	public function setChannel($channelId)
	{
		$this->channel = new Channels();
		$this->channel->setId($channelId);
	}
	
	public function setLanguages()
	{
		
	}

	public function getChannel()
	{
		return $this->channel;
	}
	
	public function getLanguages()
	{
		return $this->languages;
	}
	
	public function getConfig()
	{
		return $this->config;
	}
	
	public function getLanguagesLabels()
	{
		return $this->languagesLabels;
	}
}