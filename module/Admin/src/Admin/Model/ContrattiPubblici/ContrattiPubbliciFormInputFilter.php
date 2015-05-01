<?php

namespace Admin\Model\ContrattiPubblici;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  24 March 2015
 */
class ContrattiPubbliciFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $cig;
    public $titolo;
    public $importoAggiudicazione;
    public $importoLiquidato;
    public $scContr;
    public $respProc;
    public $inserimento;
    public $numeroOfferte;
    public $data_agg;
    public $data_contratto;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                       = (isset($data['id']))                      ? $data['id']   : null;
        $this->cig                      = (isset($data['cig']))                     ? $data['cig']   : null;
        $this->titolo                   = (isset($data['titolo']))                  ? $data['titolo']   : null;
        $this->importoAggiudicazione    = (isset($data['importoAggiudicazione']))   ? $data['importoAggiudicazione'] : null;
        $this->importoLiquidato         = (isset($data['importoLiquidato'])) ? $data['importoLiquidato'] : null;
        $this->scContr                  = (isset($data['scContr']))         ? $data['scContr']   : null;
        $this->respProc                 = (isset($data['respProc']))        ? $data['respProc']   : null;
        $this->inserimento              = (isset($data['inserimento']))     ? $data['inserimento']   : null;
        $this->numeroOfferte            = (isset($data['numeroOfferte']))   ? $data['numeroOfferte']   : null;
        $this->data_agg                 = (isset($data['data_agg']))        ? $data['data_agg']   : null;
        $this->data_contratto           = (isset($data['data_contratto']))  ? $data['data_contratto']   : null;
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
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'cig',
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
                            'max'      => 10,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'titolo',
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
                            'max'      => 255,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'importoAggiudicazione',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'importoLiquidato',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'scContr',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'respProc',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'inserimento',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'numeroOfferte',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'data_agg',
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
                            'max'      => 155,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'data_contratto',
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
                            'max'      => 155,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}