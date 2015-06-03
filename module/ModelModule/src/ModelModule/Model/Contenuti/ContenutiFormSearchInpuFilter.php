<?php

namespace ModelModule\Model\Contenuti;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ContenutiFormSearchInpuFilter implements InputFilterAwareInterface
{
    public $testo;
    public $anno;
    public $searchSubsection;
    public $sezioni;
    public $sottosezioni;
    public $utente;
    public $inhome;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->anno                     = (isset($data['anno']))             ? $data['anno'] : null;
        $this->testo                    = (isset($data['testo']))            ? $data['testo'] : null;
        $this->searchSubsection         = (isset($data['searchSubsection'])) ? $data['searchSubsection'] : null;
        $this->sezioni                  = (isset($data['sezioni'])) ? $data['sezioni'] : null;
        $this->sottosezioni             = (isset($data['sezioni'])) ? $data['sezioni'] : null;
        $this->utente                   = (isset($data['sezioni'])) ? $data['sezioni'] : null;
        $this->inhome                   = (isset($data['inhome'])) ? $data['inhome'] : null;
        $this->csrf                     = (isset($data['csrf'])) ? $data['csrf'] : null;
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
                'name'     => 'sezione',
                'required' => true,
                'options' => array(
                    'disable_inarray_validator' => false
                ),
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'anno',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1954',
                            'max' => '2060',
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}