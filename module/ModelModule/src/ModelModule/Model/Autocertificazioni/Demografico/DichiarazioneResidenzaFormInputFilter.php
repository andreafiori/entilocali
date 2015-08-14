<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use ModelModule\Model\Autocertificazioni\AutocertificazioniFormInputFilterAbstract;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Dichiarazione Residenza Form Validator
 */
class DichiarazioneResidenzaFormInputFilter extends AutocertificazioniFormInputFilterAbstract implements InputFilterAwareInterface
{
    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        parent::exchangeArray($data);
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        $inputFilter = parent::getInputFilter();

        return $inputFilter;
    }
}