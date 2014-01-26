<?php

namespace Backend\Model;

use Setup\SetupManager;
use Zend\Form\Form;

/**
 * FormSetterAbstractTest
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class FormSetterWrapper
{
	private $setupManager;

	private $formSetter;

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	/**
	 * check if a form class name isValid
	 * @param string $name
	 * @return boolean
	 */
	public function isValidFormSetter($name)
	{
		$objNamespace = "Posts\\Model\\".$name;
		if ($objNamespace instanceof FormSetterAbstract) {
			$this->formSetter = new $objNamespace( $this->setupManager );
			return true;
		}
				
		return false;
	}
	
	/**
	 * @param FormSetterAbstract $formSetter
	 */
	public function setFormSetter(FormSetterAbstract $formSetter)
	{
		$this->formSetter = $formSetter;
		
		return $this->formSetter;
	}
	
	/**
	 * @return FormSetterAbstract
	 */
	public function getFormSetter()
	{
		return $this->formSetter;
	}
	
	/**
	 * @param Form $form
	 */
	public function setForm(Form $form)
	{
		$this->formSetter->setForm($form);
	}
}