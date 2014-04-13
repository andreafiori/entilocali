<?php

namespace Application\Setup;

use Application\Model\QueryBuilderSetterAbstract;

/**
 * Get Language Labels from db and format records like label => value
 * 
 * @author Andrea Fiori
 * @since  02 April 2014
 */
class LanguagesLabelsSetup extends QueryBuilderSetterAbstract
{
	/**
	 * 
	 * @param number $languageId
	 * @return array
	 */
	public function setLanguagesLabels($languageId = 1)
	{
		$languageLabelsFromDb = $this->getQueryBuilder()->add('select', 'll.labelName, ll.labelValue, ll.description, ll.isbackend')
														->add('from', 'Application\Entity\LanguagesLabels ll ')
														->add('where', 'll.language = :language AND (ll.isbackend = 0 OR ll.isuniversal = 1) ')
														->getQuery()->getResult();
		
		return $this->formatLanguageLabelsFromDb($languageLabelsFromDb);
	}
	
	/**
	 * @param array $languageLabelsFromDb
	 * @return array $languageLabels
	 */
	private function formatLanguageLabelsFromDb(array $languageLabelsFromDb)
	{
		$languageLabels = array();
		foreach($languageLabelsFromDb as $lLabels) {
			$languageLabels[$lLabels['labelName']] = $lLabels['labelValue'];
		}
		
		return $languageLabels;
	}
}