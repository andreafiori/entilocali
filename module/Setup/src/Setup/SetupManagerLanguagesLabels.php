<?php

namespace Setup;

use Setup\SetupManagerAbstract;
use Languages\Model\LanguagesLabelsQueryBuilder;

/**
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerLanguagesLabels extends SetupManagerAbstract
{
	private $languagesLabels;
	
	public function setLanguagesLabels(LanguagesLabelsQueryBuilder $languagesLabelsQueryBuilder)
	{
		$languagesLabelsQueryBuilder->setBasicBindParameters();
		
		$this->languagesLabels = $languagesLabelsQueryBuilder->getSelectResult();

		return $this->setLanguagesLabelsAsKeyValue( $this->languagesLabels );
	}
		
		private function setLanguagesLabelsAsKeyValue(array $labelsList)
		{
			$labels = array();
			foreach($labelsList as &$labelsList) {
				if (isset($labelsList['label_name'])) {
					$labels[$labelsList['label_name']] = $labelsList['label_value'];
				}
			}
			
			return $labels;
		}
	
	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
}