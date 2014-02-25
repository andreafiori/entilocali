<?php

namespace LanguagesTest\Model;

use SetupTest\TestSuite;
use Languages\Model\LanguagesQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  24 February 2014
 */
class LanguagesQueryBuilderTest extends TestSuite
{
	private $languagesQueryBuilder;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->languagesQueryBuilder = new LanguagesQueryBuilder();
		$this->languagesQueryBuilder->setSetupManager($this->getSetupManager());
	}
	
	public function testGetSelectResult()
	{
		$this->assertNotEmpty( $this->languagesQueryBuilder->getSelectResult() );
	}
	
	public function testSetId()
	{
		$this->languagesQueryBuilder->setBasicBindParameters();
		$this->languagesQueryBuilder->setId(1);
		
		$this->assertArrayHasKey('id', $this->languagesQueryBuilder->getBindParameters());
	}
}