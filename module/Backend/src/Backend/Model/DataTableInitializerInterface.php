<?php

namespace Backend\Model;

/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
interface DataTableInitializerInterface
{
	public function setTitle();
	
	public function setDescription();
	
	public function setColumns();

	public function setColumnsValues();
}