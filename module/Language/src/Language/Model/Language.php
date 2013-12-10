<?php

namespace Language\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Language implements InputFilterAwareInterface
{
	private $factory;
	
	private $fields = array('id','language','abbrev1','abbrev2','abbrev3','defaultlang', 'defaultlang_admin','encoding','flag','active','rifchannel');
	
	protected $inputFilter;

	public function exchangeArray($data)
	{
		foreach($this->fields as $fields)
		{
			$this->$fields = (isset($data[$fields])) ? $data[$fields] : null;
		}
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Language input filter not used");
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