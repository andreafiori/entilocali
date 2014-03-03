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
		
	}
	
	public function setId($id)
	{
		if ( is_numeric($id) ) {
			$this->query .= "AND ll.id = :id ";
			$this->addToBindParameters('id', $id);
		}
	}
	
	public function setLanguage($languageId)
	{
		if ( is_numeric($languageId) ) {
			$this->query .= "AND ll.language = :languageId ";
			$this->addToBindParameters('languageId', $languageId);
		}
	}
	
	public function setIsBackend($isBackend)
	{
		if ($isBackend) {
			$this->query .= "AND ll.isBackend = :isbackend ";
			$this->addToBindParameters('isbackend', $isBackend);
		}
	}
}