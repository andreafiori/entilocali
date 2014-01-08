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
	 * 
	 * @param array $arrayToMerge
	 * @throws NullException
	 */
	public function mergeTemplateDataWithArray(array $arrayToMerge)
	{		
		$this->templateData = array_merge($this->templateData, $arrayToMerge);
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