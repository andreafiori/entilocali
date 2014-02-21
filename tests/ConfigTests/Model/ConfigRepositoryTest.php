<?php

namespace Config\Model;

use SetupTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class ConfigRepositoryTest extends TestSuite
{
	private $configRepository;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->configRepository = new ConfigRepository( $this->getEntityManagerMock() );
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
		$this->configRepository->setConfigurations( array("isbackend"=>1,"channelId"=>array(1,0) ) );
		$this->configRepository->initConfigRecord();
		
		$this->assertTrue( is_array($this->configRepository->getConfigRecord()) );
	}
}