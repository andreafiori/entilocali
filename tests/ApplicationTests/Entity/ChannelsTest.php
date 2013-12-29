<?php

namespace ApplicationTests\Entity;

use SetupTests\Model\TestSuite;
use Application\Entity\Channels;

class ChannelsTest extends TestSuite
{
	private $channels;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->channels = new Channels();
	}
	
	public function testSetId()
	{
		$this->channels->setId(1);
		$this->assertEquals($this->channels->getId(), 1);
	}
}