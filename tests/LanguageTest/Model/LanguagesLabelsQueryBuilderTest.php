<?php

namespace Languages\Model;

use Setup\DQLQueryHelper;

class LanguagesLabelsQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect("ll.label_name, ll.label_value, ll.description, ll.isbackend");
		}
		
		$q = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\LanguagesLabels ll WHERE 1 ";
	}
	
	public function setBasicBindParameters()
	{
		$this->setBindParameters( array('channel' => $this->getSetupManager()->getChannelId() ) );
	}
	
	public function setId($id)
	{
		if ( is_numeric($id) ) {
			$this->query .= "AND p.id = :id ";
			$this->addToBindParameters('id', $id);
		}
	}
}