<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Dichiarazione Residenza Form Validator
 */
class DichiarazioneResidenzaFormInputFilter implements InputFilterAwareInterface
{
    public $scelta;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id = (isset($data['id']))  ? $data['id']   : null;
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
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();

            // TODO: add filters here

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}