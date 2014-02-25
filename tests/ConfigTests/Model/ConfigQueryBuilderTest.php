<?php

namespace ConfigTest\Model;

use SetupTest\TestSuite;
use Config\Model\ConfigQueryBuilder;

class ConfigQueryBuilderTest extends TestSuite
{
	private $setupManager;
	
	private $configQueryBuilder;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->configQueryBuilder = new ConfigQueryBuilder();
		$this->configQueryBuilder->setSetupManager($this->setupManager);
	}
	
	public function testGetSelectResult()
	{		
		$this->assertNotEmpty( $this->configQueryBuilder->getSelectResult() );
	}
	
	public function testSetBasicBindParameters()
	{
		$this->configQueryBuilder->setBasicBindParameters();
		
		$this->assertTrue( is_array($this->configQueryBuilder->getBindParameters()) );
	}
	
	public function testSetName()
	{
		$this->configQueryBuilder->setBasicBindParameters();
		$this->configQueryBuilder->setName("sitename");
		
		$this->assertArrayHasKey('name', $this->configQueryBuilder->getBindParameters());
	}
}