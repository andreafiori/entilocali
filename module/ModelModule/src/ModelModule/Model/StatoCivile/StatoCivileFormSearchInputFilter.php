<?php

namespace ModelModule\Model\StatoCivile;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Stato civile form search validator
 */
class StatoCivileFormSearchInputFilter implements InputFilterAwareInterface
{
    public $testo;
    public $mese;
    public $anno;
    public $sezione;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->testo                = (isset($data['testo'])) ? $data['testo'] : null;
        $this->mese                 = (isset($data['mese'])) ? $data['mese'] : null;
        $this->anno                 = (isset($data['anno'])) ? $data['anno'] : null;
        $this->sezione              = (isset($data['sezione'])) ? $data['sezione'] : null;
        $this->csrf                 = (isset($data['csrf'])) ? $data['csrf'] : null;
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

            $inputFilter->add(array(
                'name'     => 'testo',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'mese',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'anno',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Between',
                        'options' => array(
                            'min' => 1954,
                            'max' => 2030,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'sezione',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'csrf',
                'required' => true,
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
