<?php

namespace ModelModule\Model\AlboPretorio;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AlboPretorioFormSearchInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $numero_progressivo;
    public $numero_atto;
    public $testo;
    public $mese;
    public $anno;
    public $expired;
    public $csrf;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                   = (isset($data['id'])) ? $data['id'] : null;
        $this->numero_progressivo   = (isset($data['numero_progressivo'])) ? $data['numero_progressivo'] : null;
        $this->numero_atto          = (isset($data['numero_atto'])) ? $data['numero_atto'] : null;
        $this->testo                = (isset($data['testo'])) ? $data['testo'] : null;
        $this->mese                = (isset($data['mese'])) ? $data['mese'] : null;
        $this->mese                = (isset($data['mese'])) ? $data['mese'] : null;
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



            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
