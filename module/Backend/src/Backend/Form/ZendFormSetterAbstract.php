<?php

namespace Backend\Form;

use Zend\Form\Form as ZendForm;
use Setup\SetupManager;
use Setup\SetupManagerAbstract;

/**
 * @author Andrea Fiori
 * @since  07 March 2014
 */
abstract class ZendFormSetterAbstract extends ZendForm
{
	protected $setupManager;
	
	protected $languageLabels;
	
	protected $inputRecord;
	
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManagerAbstract $setupManager)
	{
		$this->setFormName('formdata');
		
		$this->setupManager = $setupManager;
	}
	
	protected function setFormName($name)
	{
		parent::__construct($name);
	}
	
	public function setLanguageLabels()
	{
		$this->languageLabels = $this->getSetupManager()->getSetupManagerLanguagesLabels()->getLanguageLabels();

		return $this->languageLabels;
	}

	/**
	 * Set record data input it can be different from hydrator data
	 */
	public function setInputRecord($input = null)
	{
		if ($input) {
			$this->inputRecord = $input;
		}
	
		return $this->inputRecord;
	}
	
	public function getLanguageLabels()
	{
		return $this->languageLabels;
	}
	
	/**
	 * @return SetupManagerAbstract
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
	
	/**
	 * @return array
	 */
	public function getInputRecord()
	{
		return $this->inputRecord;
	}
	
	abstract public function addFormFields();
}
