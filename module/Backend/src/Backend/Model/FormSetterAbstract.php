<?php

namespace Backend\Model;

use Zend\Form\Form;
use Setup\SetupManager;

/**
 * FormSetter
 * @author Andrea Fiori
 * @since  26 January 2014
 */
abstract class FormSetterAbstract
{
	protected $setupManager;
	
	protected $form, $action, $title, $description;
	
	protected $record;

	protected $zendFormObjectClassName;

	abstract public function setRecord($id);

	abstract public function setTitle();

	abstract public function setDescription();
	
	abstract public function setAction();

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function getRecord()
	{
		return $this->record;
	}

	/**
	 * @return Form
	 */
	public function getForm()
	{
		return $this->form;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getDescription()
	{
		return $this->description;
	}

	public function getZendFormClassName()
	{
		return $this->zendFormObjectClassName;
	}
	
	public function getAction()
	{
		return $this->action;
	}	
}