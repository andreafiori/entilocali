<?php

namespace Languages\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  25 February 2014
 */
class LanguagesLabelsQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect("ll.labelName, ll.labelValue, ll.description, ll.isbackend");
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\LanguagesLabels ll WHERE ll.id IS NOT NULL ";
	}
	
	public function setBasicBindParameters()
	{
		$this->setBindParameters( array() );
	}
	
	public function setId($id)
	{
		if ( is_numeric($id) ) {
			$this->query .= "AND ll.id = :id ";
			$this->addToBindParameters('id', $id);
		}
	}
}