<?php

namespace ModelModule\Model\Contenuti;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ContenutiTabellaFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $tabella;
    public $csrf;

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput([
                'name' => 'tabella',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                ),
            ]));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}