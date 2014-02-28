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

	public function setId($id)
	{
		if ( is_numeric($id) ) {
			$this->query .= "AND ll.id = :id ";
			$this->addToBindParameters('id', $id);
		}
	}
}