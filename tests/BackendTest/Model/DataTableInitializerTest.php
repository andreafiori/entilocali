<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Model\DataTableInitializer;

/**
 * @author Andrea Fiori
 * @since  05 March 2014
 */
class DataTableInitializerTest extends TestSuite
{
	private $dataTableInitializer;

	private $setupManager;

	protected function setUp()
	{
		parent::setUp();

		$this->dataTableInitializer = new DataTableInitializer();
	}
	
	public function testSetTitle()
	{
		$this->dataTableInitializer->setTitle('Data Table title');
		
		$this->assertEquals($this->dataTableInitializer->getTitle(), 'Data Table title');
	}
	
	public function testSetDescription()
	{
		$this->dataTableInitializer->setDescription('Data Table Description');
		
		$this->assertEquals($this->dataTableInitializer->getDescription(), 'Data Table Description');
	}
	
	public function testSetColumns()
	{
		$this->dataTableInitializer->setColumns( array("surname","firstname","email") );
		
		$this->assertEquals($this->dataTableInitializer->getColumns(), array("surname","firstname","email"));
	}
	
	public function testSetColumnsValues()
	{
		$this->dataTableInitializer->setColumnsValues( array("John","Doe","johndoe@johndoeemail.com") );
	
		$this->assertEquals($this->dataTableInitializer->getColumnsValues(), array("John","Doe","johndoe@johndoeemail.com") );
	}
}