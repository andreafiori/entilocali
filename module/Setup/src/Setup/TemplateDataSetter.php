<?php

namespace Setup;

/**
 * TemplateDataSetter
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class TemplateDataSetter {

	private $templateData = array();
	
	private $setupManager;

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	/**
	 * if $key is specified, 
	 * @param array $arrayToMerge
	 * @param string $key
	 */
	public function mergeTemplateDataWithArray(array $arrayToMerge, $key = null)
	{
		if (!is_array($this->templateData)) {
			$this->templateData = $arrayToMerge;
			return;
		}
		
		if (!$key) {
			$this->templateData = array_merge($this->templateData, $arrayToMerge);
		} else {
			if (isset($this->templateData[$key])) {
				$this->templateData[$key] = array_merge($this->templateData[$key], $arrayToMerge);
			} else {
				$this->templateData[$key] = $arrayToMerge;
			}
		}
	}

	public function setTemplateData(array $templateData)
	{
		$this->templateData = $templateData;
	}

	public function getTemplateData($key = null)
	{
		if ( isset($this->templateData[$key]) ) {
			return $this->templateData[$key];
		} elseif (!isset($this->templateData[$key]) and $key!=null) {
			return false;
		}

		return $this->templateData;
	}

	public function assignToTemplate($key, $value)
	{
		$this->templateData[$key] = $value;
	}
}