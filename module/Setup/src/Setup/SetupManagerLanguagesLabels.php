<?php

namespace Setup;

use Setup\SetupManagerAbstract;

/**
 * @author Andrea Fiori
 * @since  13 January 2014
 */
class SetupManagerLanguagesLabels extends SetupManagerAbstract
{
	private $languagesLabels;
	
	public function setLanguagesLabels(array $labelsList)
	{	
		$this->languagesLabels = array();
		foreach($labelsList as &$labelsList) {
			if ( isset($labelsList['labelName']) and isset($labelsList['labelValue']) ) {
				$this->languagesLabels[$labelsList['labelName']] = $labelsList['labelValue'];
			}
		}
		
		return $this->languagesLabels;
	}
	
	public function getLanguageLabels()
	{
		return $this->languagesLabels;
	}
}