<?php

namespace Backend\Model;

/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
class DataTableInitializer extends DataTableAbstract
{
	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this->title;
	}
	
	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		
		return $this->description;
	}
	
	/**
	 * @return array $columns
	 */
	public function setColumns(array $colums)
	{
		$this->columns = $colums;
		
		return $this->columns;
	}
	
	/**
	 * @return array $columnValues
	 */
	public function setColumnsValues(array $columnValues)
	{
		$this->columnsValues = $columnValues;
		
		return $this->columnsValues;
	}
}