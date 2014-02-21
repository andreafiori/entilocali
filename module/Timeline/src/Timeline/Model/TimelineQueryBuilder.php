<?php

namespace Timeline\Model;

use Setup\DQLQueryHelper;

/**
 * @author Andrea Fiori
 * @since  10 January 2014
 */
class TimelineQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect('DISTINCT(t.id) AS timelineuid, t.century, t.year, to.image, to.title, to.description');
		}
		
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Timeline t, Application\\Entity\\TimelineOptions to WHERE ( t.id = to.timeline ) AND to.language = :language ";
	}
	
	public function setBasicBindParameters()
	{
		$this->setBindParameters( array(
				//'channel' => $this->getSetupManager()->getChannelId(),
				'language' => $this->getSetupManager()->getSetupManagerLanguages()->getLanguageId()
		) );
	}
	
	public function setId($id)
	{
		if ( !is_numeric($id) ) {
			return false;
		}
	
		$this->query .= "AND t.id = :id ";
		$this->addToBindParameters('id', $id);
	}
	
	public function setCentury($century)
	{
		if ( !is_numeric($century) ) {
			return false;
		}
		
		$this->query .= "AND t.century = :century ";
		$this->addToBindParameters('century', $century);
	}
	
	public function setYear($year)
	{
		if ( !is_numeric($year) ) {
			return false;
		}

		$this->query .= "AND t.year = :year ";
		$this->addToBindParameters('year', $year);
	}

	/*
	$timeline = new TimelineQueryBuilder();
	$timeline->setSetupManager($setupManager);
	$timeline->setBasicBindParameters();
	$timeline->getSelectResult();
	*/
}