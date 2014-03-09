<?php

namespace Categories\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  03 January 2014
 */
class CategoriesQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if ( !$this->getDefaultFieldsSelect() ) {
			$this->setDefaultFieldsSelect('DISTINCT(c.id) AS catid, co.name, c.id');
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Categories c, Application\\Entity\\CategoriesOptions co
WHERE (co.category = c.id ) ";
	}
	
	public function setId($id)
	{
		if (!is_int($id)) {
			return false;
		}
		$this->query .= "AND c.id = :id ";
		
		$this->addToBindParameters('id', $id);
	}
	
	public function setParentId($parentId = 0)
	{
		$this->query .= "AND co.parentId = :parentid ";
		
		$this->addToBindParameters('parentid', $parentId);
	}
	
	public function setName($name)
	{
		if (!$name) {
			return false;
		}
		
		$this->query .= "AND co.name = :name ";
		
		$this->addToBindParameters('name', $name);
	}
	
	public function setModuleId($moduleId)
	{
		$this->query .= "AND co.moduleId = :moduleId ";
		
		$this->addToBindParameters('moduleId', $moduleId);
	}
}