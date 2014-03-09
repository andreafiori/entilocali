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
	
	protected $title;
	
	protected $description;

	protected $setupManager, $labels;
	
	protected $column;
	
	protected $columnValues;
	
	/**
	 * @param array $input
	 */
	public function setInput(array $input)
	{
		$this->input = $input;
		
		return $this->input;
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
	
	/**
	 * @param SetupManager $setupManager
	 */
	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
		
		return $this->setupManager;
	}

	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
}