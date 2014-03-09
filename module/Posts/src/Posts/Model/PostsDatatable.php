<?php

namespace Posts\Model;

use Backend\Model\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
class PostsDatatable extends DataTableAbstract
{
	public function setTitle()
	{
		$this->title = 'Rassegna stampa';
		
		return $this->title;
	}
	
	public function setDescription()
	{
		$this->description = 'Gestisci post blog';
		
		return $this->description;
	}

	/**
	 * @return array
	 */
	public function setColumns()
	{
		$this->columns = array("Titolo", "Categoria", "&nbsp;", "&nbsp;");
		
		return $this->columns;
	}
	
	/**
	 * @return array
	 */
	public function setColumnsValues()
	{
		$this->columnsValues = array();
		
		return $this->columnsValues;
	}
}