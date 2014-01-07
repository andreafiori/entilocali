<?php

namespace Setup;

use Setup\SetupManager;
use Setup\NullException;

class TemplateDataSetter {
	
	private $templateData, $setupManager;
	
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
		if (!$this->templateData) {
			throw new NullException();
		}
		
		$this->templateData = array_merge($this->templateData, $arrayToMerge);
	}
	
	public function setTemplateData(array $templateData)
	{
		$this->templateData = $templateData;
	}
	
	public function getTemplateData()
	{
		return $this->templateData;
	}
}