<?php

namespace Config\Model;

use Setup\DQLQueryHelper;

class ConfigQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect("c.name, c.value ");
		}
		
		$this->query = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Config c WHERE 1 ";
	}

	public function setBasicBindParameters()
	{
		$this->setBindParameters( array('channel' => $this->getSetupManager()->getChannelId(), 'language' => $this->getSetupManager()->getSetupManagerLanguages()->getLanguageId() ) );
	}
	
	public function setName($name)
	{
		if (!$name) {
			return false;
		}

		$this->query .= "AND c = :name ";
		$this->addToBindParameters('name', $name);
	}
}