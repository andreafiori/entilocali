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
    public $importo;
    public $importo2;
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
        $this->id               = (isset($data['id']))              ? $data['id']   : null;
        $this->cig              = (isset($data['cig']))             ? $data['cig']   : null;
        $this->titolo           = (isset($data['titolo']))          ? $data['titolo']   : null;
        $this->importo          = (isset($data['importo']))         ? $data['importo']   : null;
        $this->importo2         = (isset($data['importo2']))        ? $data['importo2']   : null;
        $this->scContr          = (isset($data['scContr']))         ? $data['scContr']   : null;
        $this->respProc         = (isset($data['respProc']))        ? $data['respProc']   : null;
        $this->inserimento      = (isset($data['inserimento']))     ? $data['inserimento']   : null;
        $this->numeroOfferte    = (isset($data['numeroOfferte']))   ? $data['numeroOfferte']   : null;
        $this->data_agg         = (isset($data['data_agg']))        ? $data['data_agg']   : null;
        $this->data_contratto   = (isset($data['data_contratto']))  ? $data['data_contratto']   : null;
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