<?php
namespace Language\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Language implements InputFilterAwareInterface
{
	private $factory;

	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id   = (isset($data['id'])) ? $data['id'] : null;
		$this->language   = (isset($data['language'])) ? $data['language'] : null;
		$this->abbrev1   = (isset($data['abbrev1'])) ? $data['abbrev1'] : null;
		$this->abbrev2   = (isset($data['abbrev2'])) ? $data['abbrev2'] : null;
		$this->abbrev3   = (isset($data['abbrev3'])) ? $data['abbrev3'] : null;
		$this->defaultlang   = (isset($data['defaultlang'])) ? $data['defaultlang'] : null;
		$this->defaultlang_admin  = (isset($data['defaultlang_admin'])) ? $data['defaultlang_admin'] : null;
		$this->encoding  = (isset($data['encoding'])) ? $data['encoding'] : null;
		$this->flag  = (isset($data['flag'])) ? $data['flag'] : null;
		$this->active  = (isset($data['active'])) ? $data['active'] : null;
		$this->rifchannel  = (isset($data['rifchannel'])) ? $data['rifchannel'] : null;
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
			$inputFilter->add( $this->getFactoryIntInputArray('active') );
			$inputFilter->add( $this->getFactoryIntInputArray('defaultlang') );
			$inputFilter->add( $this->getFactoryIntInputArray('defaultlang_admin') );
			$inputFilter->add( $this->getFactoryIntInputArray('rifchannel') );
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