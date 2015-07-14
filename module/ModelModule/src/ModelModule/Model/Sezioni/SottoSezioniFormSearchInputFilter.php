<?php

namespace ModelModule\Model\Sezioni;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\File\Size;

/**
 * SottoSezioni Form Search Validator
 */
class SottoSezioniFormSearchInputFilter implements InputFilterAwareInterface
{
    public $testo;
    public $sezioni;
    public $csrf;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->testo    = (isset($data['testo']))   ? $data['testo']    : null;
        $this->sezioni  = (isset($data['sezioni'])) ? $data['sezioni']  : null;
        $this->csrf     = (isset($data['csrf']))    ? $data['csrf']     : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add(array(
                'name'     => 'sezioni',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'testo',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ]));

            $inputFilter->add(array(
                'name' => 'csrf',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}