<?php

namespace Language\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Language implements InputFilterAwareInterface
{
	public $id;
	public $language;
	public $abbrev1;
	
	private $fields = array('id','language','abbrev1','abbrev2','abbrev3','defaultlang', 'defaultlang_admin','encoding','flag','active','channel_id');
	
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id']))     ? $data['id']     : null;
		$this->language = (isset($data['language'])) ? $data['language'] : null;
		$this->abbrev1  = (isset($data['abbrev1']))  ? $data['abbrev1']  : null;
		$this->abbrev2  = (isset($data['abbrev2']))  ? $data['abbrev2']  : null;
		$this->abbrev3  = (isset($data['abbrev3']))  ? $data['abbrev3']  : null;
		/*
		$this->defaultlang  = (isset($data['defaultlang']))  ? $data['defaultlang']  : null;
		$this->defaultlang_admin  = (isset($data['defaultlang_admin']))  ? $data['defaultlang_admin']  : null;
		$this->encoding  = (isset($data['encoding']))  ? $data['encoding']  : null;
		$this->flag  = (isset($data['flag']))  ? $data['flag']  : null;
		$this->active  = (isset($data['active']))  ? $data['active']  : null;
		$this->channel_id  = (isset($data['channel_id']))  ? $data['channel_id']  : null;
		*/
	}

	// Add the following method:
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
					'name'     => 'language',
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

			$inputFilter->add($factory->createInput(array(
					'name'     => 'abbrev1',
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
