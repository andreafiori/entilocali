<?php

namespace Config\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Config implements InputFilterAwareInterface
{
	private $factory;
	
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id']))     ? $data['id']     : null;
		$this->name   = (isset($data['name']))     ? $data['name']     : null;
		$this->value  = (isset($data['value']))     ? $data['value']     : null;
		$this->isadmin  = (isset($data['isadmin']))     ? $data['isadmin']     : null;
		$this->module_id  = (isset($data['module_id']))     ? $data['module_id']     : null;
		$this->channel_id  = (isset($data['channel_id']))     ? $data['channel_id']     : null;
		$this->language_id  = (isset($data['language_id']))     ? $data['language_id']     : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Config input filter not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$inputFilter->add( $this->getFactoryIntInputArray('id') );
			$inputFilter->add( $this->getFactoryIntInputArray('isadmin') );
			$inputFilter->add( $this->getFactoryIntInputArray('module_id') );
			$inputFilter->add( $this->getFactoryIntInputArray('channel_id') );
			$inputFilter->add( $this->getFactoryIntInputArray('language_id') );
			$this->inputFilter = $inputFilter;
		}
		
		return $this->inputFilter;
	}
	
		/**
		 * get the common input filter for an integer
		 * @param string $name
		 * @return \Zend\InputFilter\Factory
		 */
		private function getFactoryIntInputArray($name)
		{
			if (!$this->factory) $this->factory = new InputFactory();
			$this->factory->createInput(array(
					'name'     => $name,
					'required' => true,
					'filters'  => array( array('name' => 'Int') ),
			));
			return $this->factory;
		}
}