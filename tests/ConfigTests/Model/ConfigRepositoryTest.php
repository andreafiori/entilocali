<?php

namespace Config\Model;

use SetupTest\TestSuite;

class ConfigRepositoryTest extends TestSuite {
	
	private $configRepository;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->configRepository = new ConfigRepository( $this->getServiceManager()->get('\Doctrine\ORM\EntityManager') );
	}
	
	public function testSetConfigurations()
	{
		$this->configRepository->setConfigurations();
		
		$this->assertTrue( is_array($this->configRepository->getConfigurations()) );
	}
	
	/**
	 * @expectedException \Setup\NullException
	 */
	public function testSetConfigRecordLaunchException()
	{
		$this->configRepository->initConfigRecord();
	}
	
	public function testGetConfigRecord()
	{
		$this->configRepository->setConfigurations( array("isbackend"=>1,"channel"=>1) );
		$this->configRepository->initConfigRecord();
		
		$this->assertTrue( is_array($this->configRepository->getConfigRecord()) );
	}
}