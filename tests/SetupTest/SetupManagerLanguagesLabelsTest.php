<?php

namespace SetupTest;

use Setup\SetupManagerLanguagesLabels;
use Languages\Model\LanguagesLabelsRepository;

class SetupManagerLanguagesLabelsTest extends TestSuite
{
	private $setupManagerLanguagesLabels;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManagerLanguagesLabels = new SetupManagerLanguagesLabels();
	}
	
	public function testSetLanguagesLabelsRepository()
	{
		$this->assertTrue( $this->setupManagerLanguagesLabels->setLanguagesLabelsRepository(new LanguagesLabelsRepository($this->getDoctrineEntityManager())) instanceof LanguagesLabelsRepository );
	}
}