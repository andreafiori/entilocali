<?php

namespace Backend\Model;

use Setup\SetupManager;


/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
abstract class DataTableAbstract
{
	protected $input;
	
	protected $title, $description, $columns, $columnsValues;

	protected $initializer;

	protected $labels;

	protected $setupManager;
	
	/**
	 * 
	 * @param array $input
	 */
	public function setInput(array $input)
	{
		$this->input = $input;
	}

	public function setInitializer(DatatableInitializerAbstract $initializer)
	{
		$this->initializer = $initializer;
	}
	
	/**
	 * @return DataTableInitializerAbstract
	 */
	public function getInitializer()
	{
		return $this->initializer;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function getColumnsValues()
	{
		return $this->columnsValues;
	}

	public function setLabels(array $labels)
	{
		return $this->labels;
	}

	public function getLabels()
	{
		return $this->labels;
	}

	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function getSetupManager()
	{
		return $this->setupManager;
	}
}