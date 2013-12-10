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
		$this->rifmodule  = (isset($data['rifmodule']))     ? $data['rifmodule']     : null;
		$this->rifchannel  = (isset($data['rifchannel']))     ? $data['rifchannel']     : null;
		$this->riflanguage  = (isset($data['riflanguage']))     ? $data['riflanguage']     : null;
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
			$inputFilter->add( $this->getFactoryIntInputArray('rifmodule') );
			$inputFilter->add( $this->getFactoryIntInputArray('rifchannel') );
			$inputFilter->add( $this->getFactoryIntInputArray('riflanguage') );
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