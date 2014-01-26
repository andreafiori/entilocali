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
	protected $form, $formTitle, $formDescription;
	protected $record;
	protected $setupManager;
	
	abstract public function setRecord($id);
	abstract public function setFormTitle();
	abstract public function setFormDescription();

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function getRecord()
	{
		return $this->record;
	}
	
	public function setForm(Form $form)
	{
		$this->form = $form;
	
		return $this->form;
	}
	
	/**
	 *
	 * @return Form
	 */
	public function getForm()
	{
		return $this->form;
	}
	
	public function getFormTitle()
	{
		return $this->formTitle;
	}
	
	public function getFormDescription()
	{
		return $this->formDescription;
	}
}
