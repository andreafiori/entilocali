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
    public $titolo;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id               = (isset($data['id']))      ? $data['id']         : null;
        $this->tabella          = (isset($data['tabella'])) ? $data['tabella']    : null;
        $this->titolo           = (isset($data['titolo'])) ? $data['titolo']      : null;
        $this->csrf             = (isset($data['csrf']))    ? $data['csrf']       : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("This method is unused");
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'titolo',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'tabella',
                'required' => true,
                'filters' => array(

                ),
            ]));

            $inputFilter->add(array(
                'name'     => 'csrf',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}