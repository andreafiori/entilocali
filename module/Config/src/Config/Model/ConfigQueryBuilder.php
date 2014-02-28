<?php

namespace Config\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  24 February 2014
 */
class ConfigQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect("c.name, c.value ");
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Config c WHERE c.channelId IN ( :channel , 0 ) AND c.languageId IN ( :language , 0 ) ";
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

		$this->query .= "AND c.name = :name ";
		$this->addToBindParameters('name', $name);
	}
	
	public function setValue($value)
	{
		if (!$value) {
			return false;
		}
	
		$this->query .= "AND c.value = :value ";
		$this->addToBindParameters('value', $value);
	}
	
	public function setChannelId($channelId)
	{
		if ( !is_numeric($channelId) ) {
			return false;
		}

		$this->query .= "AND c.channelId = :channelId ";
		$this->addToBindParameters('channelId', $channelId);
	}
	
	public function setLanguageId($languageId)
	{
		if ( !is_numeric($languageId) ) {
			return false;
		}
	
		$this->query .= "AND c.languageId = :languageId ";
		$this->addToBindParameters('languageId', $languageId);
	}
}