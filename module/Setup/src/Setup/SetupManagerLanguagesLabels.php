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
		
		$this->languagesLabels = $this->setLanguagesLabelsAsKeyValue( $languagesLabelsQueryBuilder->getSelectResult() );
		
		return $this->languagesLabels;
	}
		
		private function setLanguagesLabelsAsKeyValue(array $labelsList)
		{
			$labels = array();
			foreach($labelsList as &$labelsList) {
				if (isset($labelsList['labelName']) and isset($labelsList['labelValue'])) {
					$labels[$labelsList['labelName']] = $labelsList['labelValue'];
				}
			}
			
			return $labels;
		}
	
	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
}