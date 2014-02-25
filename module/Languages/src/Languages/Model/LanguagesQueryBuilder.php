<?php

namespace Languages\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  24 February 2014
 */
class LanguagesQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect("");
		}
		
		$q = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Languages l WHERE 1 ";
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