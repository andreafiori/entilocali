<?php

namespace LanguagesTest\Model;

use SetupTest\TestSuite;
use Languages\Model\LanguagesLabelsQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  25 February 2014
 */
class LanguagesLabelsQueryBuilderTest extends TestSuite
{
	private $languagesLabelsQueryBuilder;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->languagesLabelsQueryBuilder = new LanguagesLabelsQueryBuilder();
		$this->languagesLabelsQueryBuilder->setSetupManager($this->getSetupManager());
	}
	
	public function testGetSelectResult()
	{
		$this->assertNotEmpty( $this->languagesLabelsQueryBuilder->getSelectResult() );
	}

	public function testSetId()
	{
		$this->languagesLabelsQueryBuilder->setBasicBindParameters();
		$this->languagesLabelsQueryBuilder->setId(1);
	
		$this->assertArrayHasKey('id', $this->languagesLabelsQueryBuilder->getBindParameters());
	}
	
	public function testSetLanguage()
	{
		$this->languagesLabelsQueryBuilder->setBasicBindParameters();
		$this->languagesLabelsQueryBuilder->setLanguage(1);
	
		$this->assertArrayHasKey('languageId', $this->languagesLabelsQueryBuilder->getBindParameters());
	}
}