<?php

/* TODO: TO REMOVE!!!
namespace Languages\Model;

use Setup\QueryMakerAbstract;

class LanguagesLabelsRepository extends QueryMakerAbstract
{
	protected $repository = 'Application\Entity\LanguagesLabels';

	private $languageEntity;
	
	public function getLabels(array $arraySearch)
	{
		$labelsObject = $this->convertArrayOfObjectToArray( $this->getFindFromRepository($arraySearch) );

		$labels = array();
		foreach($labelsObject as &$labelsObject) {
			$labels[$labelsObject['label_name']] = $labelsObject['label_value'];
		}

		return $labels;
	}
}
*/