<?php

namespace Backend\Model;

use Setup\NullException;

/**
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class FormSetterWrapper extends FormSetterWrapperAbstract
{
	public function setFormSetterClassName($className)
	{
		$this->formSetterClassName = $this->getBackendFormSetterNamespacePrefix().$className;
		
		return $this->formSetterClassName;
	}

	/**
	 * @return FormSetterAbstract
	 */
	public function setFormSetterInstance()
	{
		$className = $this->getFormSetterClassName();
		if ( !class_exists($className) ) {
			return false;
		}
		
		$instance = new $className( $this->getSetupManager() );
		if ($instance instanceof FormSetterAbstract) {
			$this->formSetterInstance = $instance;
		}
		
		return $this->formSetterInstance;
	}
	
	/**
	 * @param int $id
	 * @return array
	 */
	public function setFormSetterRecord($id)
	{
		if ( $this->isSetFormSetterInstance() ) {
			return $this->getFormSetterInstance()->setRecord($id);
		}
	}
	
	public function setFormSetterAction()
	{
		if ( $this->isSetFormSetterInstance() ) {
			return $this->getFormSetterInstance()->setAction();
		}
	}
	
	public function setFormSetterTitle($input = null)
	{
		if ( $this->isSetFormSetterInstance() ) {
			return $this->getFormSetterInstance()->setTitle($input);
		}
	}
	
	public function setFormSetterDescription($input = null)
	{
		if ( $this->isSetFormSetterInstance() ) {
			return $this->getFormSetterInstance()->setDescription($input);
		}		
	}

	public function setZendFormClassName()
	{
		if ( $this->isSetFormSetterInstance() ) {
			$this->zendFormClassName = $this->getFormSetterInstance()->getZendFormClassName();
		}
		
		return $this->zendFormClassName;
	}

	/**
	 * @return \Zend\Form\Form
	 */
	public function setZendFormInstance()
	{
		$className = $this->zendFormClassName;
		if ( class_exists($className) ) {
			$this->zendFormInstance = new $className($this->getSetupManager());
		}

		return $this->zendFormInstance;
	}
	
	/**
	 * set HTML form properties without include the form fields
	 * @param string $action
	 */
	public function initializeForm($action = '')
	{
		$this->checkZendFormInstance('Zend Form Instance is not set on '.__METHOD__);
		
		$this->getZendFormInstance()->setAttribute('method', 'post');
		$this->getZendFormInstance()->setAttribute('enctype', 'multipart/form-data');
		$this->getZendFormInstance()->setAttribute('class', 'form-horizontal');
		$this->getZendFormInstance()->setAttribute('role', 'form');
		$this->getZendFormInstance()->setAttribute('action', $action);
	}
	
	/**
	 * add form field and hydrate it if it has the record
	 */
	public function setFormRecord()
	{
		$this->checkFormSetterInstance('Form Setter Instance is not set on '.__METHOD__);
		$this->checkZendFormInstance('Zend Form Instance is not set on '.__METHOD__);
		
		$this->getZendFormInstance()->setLanguageLabels();
		$this->getZendFormInstance()->setInputRecord( $this->getFormSetterInstance()->getRecord() );
		
		$record = $this->getFormSetterInstance()->getRecord();
		if ($record) {
			$this->getZendFormInstance()->addFormFields();
			$this->getZendFormInstance()->setData($record[0]);
		} else {
			$this->getZendFormInstance()->addFormFields();
		}
	}
	
		private function isSetFormSetterInstance()
		{
			if ( $this->getFormSetterInstance() ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * @throws NullException
		 */
		private function checkFormSetterInstance($message)
		{
			if ( !$this->getFormSetterInstance() ) {
				throw new NullException($message);
			}
		}
		
		/**
		 * @throws NullException
		 */
		private function checkZendFormInstance($message)
		{
			if ( !$this->getZendFormInstance() ) {
				throw new NullException($message);
			}
		}
}