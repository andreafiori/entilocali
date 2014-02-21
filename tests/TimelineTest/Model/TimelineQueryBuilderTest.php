<?php

namespace TimelineTest\Model;

use ServiceLocatorFactory\ServiceLocatorFactory;
use SetupTest\TestSuite;
use Timeline\Model\TimelineQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  10 February 2014
 */
class TimelineQueryBuilderTest extends TestSuite
{
	private $timelineQueryBuilder;

	private $setupManager;

	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = $this->getSetupManager();

		$this->timelineQueryBuilder = new TimelineQueryBuilder();
		$this->timelineQueryBuilder->setSetupManager($this->setupManager);
	}

	public function testGetQueryResult()
	{
		$this->timelineQueryBuilder->setBasicBindParameters();
		$this->timelineQueryBuilder->setQueryBasic();

		$this->assertTrue( is_array($this->timelineQueryBuilder->getSelectResult()) );
	}
	
	public function testSetId()
	{
		$this->timelineQueryBuilder->setBasicBindParameters();
		$this->timelineQueryBuilder->setId(1);

		$this->assertArrayHasKey('id', $this->timelineQueryBuilder->getBindParameters());
	}
	
	public function testSetCentury()
	{
		$this->timelineQueryBuilder->setBasicBindParameters();
		$this->timelineQueryBuilder->setCentury(1930);

		$this->assertArrayHasKey('century', $this->timelineQueryBuilder->getBindParameters());
	}
	
	public function testSetYear()
	{
		$this->timelineQueryBuilder->setBasicBindParameters();
		$this->timelineQueryBuilder->setYear(1982);
	
		$this->assertArrayHasKey('year', $this->timelineQueryBuilder->getBindParameters());
	}
}