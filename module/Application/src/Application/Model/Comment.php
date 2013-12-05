<?php

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Comment implements InputFilterAwareInterface
{
	public $id, $message, $rifuser;
	
	public $name, $email;
	
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id']))     ? $data['id']     : null;
		$this->message = (isset($data['message'])) ? $data['message'] : null;
		$this->rifuser  = (isset($data['rifuser']))  ? $data['rifuser']  : null;
		
		$this->name  = (isset($data['name']))  ? $data['name']  : null;
		$this->email  = (isset($data['email']))  ? $data['email']  : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();

			$inputFilter->add($factory->createInput(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
						array('name' => 'Int'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'rifuser',
					'required' => true,
					'filters'  => array(
						array('name' => 'Int'),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'message',
					'required' => true,
					'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
					),
					'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 1,
										'max'      => 100,
								),
						),
					),
			)));

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}