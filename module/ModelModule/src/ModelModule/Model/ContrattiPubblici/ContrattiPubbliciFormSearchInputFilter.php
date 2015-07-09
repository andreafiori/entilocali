<?php

namespace ModelModule\Model\ContrattiPubblici;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Stato civile form search validator
 */
class ContrattiPubbliciFormSearchInputFilter implements InputFilterAwareInterface
{
    public $anno;
    public $cig;
    public $settore;
    public $importo;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->anno                 = (isset($data['anno'])) ? $data['anno'] : null;
        $this->cig                  = (isset($data['cig'])) ? $data['cig'] : null;
        $this->settore              = (isset($data['settore'])) ? $data['settore'] : null;
        $this->importo              = (isset($data['importo'])) ? $data['importo'] : null;
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
                'name'     => 'cig',
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
                            'max'      => 11,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'importo',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'settore',
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
