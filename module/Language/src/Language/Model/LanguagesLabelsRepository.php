<?php

namespace Language\Model;

use Setup\QueryMakerAbstract;
use Application\Entity\Languages;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class LanguagesLabelsRepository extends QueryMakerAbstract {
	
	protected $repository = 'Application\Entity\LanguagesLabels';

	private $languageEntity;
	
	/**
	 * get the label with name -> key value format
	 * @param array $arraySearch
	 * @throws InvalidArgumentException
	 * @return array
	 */
	public function getLabels(array $arraySearch)
	{
		$labelsObject = $this->convertArrayOfObjectToArray( $this->getFindFromRepository($arraySearch) );
		
		$labels = array();
		foreach($labelsObject as &$labelsObject)
		{
			$labels[$labelsObject['label_name']] = $labelsObject['label_value'];
		}
		
		return $labels;
	}
}