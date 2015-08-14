<?php

namespace ModelModule\Model\Autocertificazioni\Demografico;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Dichiarazione atto notorieta 1 form validator
 */
class DichiarazioneAttoNotorieta1FormInputFilter implements InputFilterAwareInterface
{
    public $cognome;
    public $nome;
    public $sesso;
    public $stato_nascita;
    public $provincia_nascita;
    public $luogo_nascita;
    public $data_nascita;
    public $luogo_residenza;
    public $provincia_residenza;
    public $indirizzo_residenza;
    public $numero_residenza;
    public $dichiara;
    public $luogodichiarazione;
    public $datadichiarazione;
    public $firma;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->cognome = (isset($data['cognome']))  ? $data['cognome'] : null;
        $this->nome = (isset($data['nome']))  ? $data['nome'] : null;
        $this->sesso = (isset($data['sesso']))  ? $data['sesso'] : null;
        $this->stato_nascita = (isset($data['stato_nascita']))  ? $data['stato_nascita'] : null;
        $this->provincia_nascita = (isset($data['provincia_nascita']))  ? $data['provincia_nascita'] : null;
        $this->luogo_nascita = (isset($data['luogo_nascita']))  ? $data['luogo_nascita'] : null;
        $this->data_nascita = (isset($data['data_nascita']))  ? $data['data_nascita'] : null;
        $this->luogo_residenza = (isset($data['luogo_residenza']))  ? $data['luogo_residenza'] : null;
        $this->provincia_residenza = (isset($data['provincia_residenza']))  ? $data['provincia_residenza'] : null;
        $this->indirizzo_residenza = (isset($data['indirizzo_residenza']))  ? $data['indirizzo_residenza'] : null;
        $this->numero_residenza = (isset($data['numero_residenza']))  ? $data['numero_residenza'] : null;
        $this->dichiara = (isset($data['dichiara']))  ? $data['dichiara'] : null;
        $this->luogodichiarazione = (isset($data['luogodichiarazione']))  ? $data['luogodichiarazione'] : null;
        $this->datadichiarazione = (isset($data['datadichiarazione']))  ? $data['datadichiarazione'] : null;
        $this->firma = (isset($data['firma']))  ? $data['firma'] : null;
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