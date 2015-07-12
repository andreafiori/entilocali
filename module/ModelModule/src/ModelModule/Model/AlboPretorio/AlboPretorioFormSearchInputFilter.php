<?php

namespace ModelModule\Model\AlboPretorio;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Albo Pretorio form search validator
 */
class AlboPretorioFormSearchInputFilter implements InputFilterAwareInterface
{
    public $numero_progressivo;
    public $numero_atto;
    public $testo;
    public $mese;
    public $anno;
    public $sezione;
    public $expired;
    public $home;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->numero_progressivo   = (isset($data['numero_progressivo'])) ? $data['numero_progressivo'] : null;
        $this->numero_atto          = (isset($data['numero_atto'])) ? $data['numero_atto'] : null;
        $this->testo                = (isset($data['testo'])) ? $data['testo'] : null;
        $this->mese                 = (isset($data['mese'])) ? $data['mese'] : null;
        $this->anno                 = (isset($data['anno'])) ? $data['anno'] : null;
        $this->sezione              = (isset($data['sezione'])) ? $data['sezione'] : null;
        $this->expired              = (isset($data['expired'])) ? $data['expired'] : null;
        $this->home                 = (isset($data['home'])) ? $data['home'] : null;
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
                'name'     => 'numero_atto',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'numero_progressivo',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'mese',
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
                'name'     => 'expired',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'home',
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
