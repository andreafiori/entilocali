<?php

namespace Application\Model;

use Setup\SetupManager;

class TemplateDataSetter {
	
	private $templateData, $setupManager;
	
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function setTemplateData()
	{
		
	}
	
	public function getTemplateData()
	{
		return $this->templateData;
	}
}