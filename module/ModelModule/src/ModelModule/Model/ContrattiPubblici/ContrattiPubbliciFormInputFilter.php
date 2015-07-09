<?php

namespace ModelModule\Model\ContrattiPubblici;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Contratti Pubblici Admin Form Validator
 */
class ContrattiPubbliciFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $beneficiario;
    public $titolo;
    public $numeroDetermina;
    public $dataDetermina;
    public $importoAggiudicazione;
    public $importoLiquidato;
    /* public $operatori; */
    public $numeroOfferte;
    public $dataInizioLavori;
    public $dataFineLavori;
    public $anno;
    public $data;
    public $ora;
    public $attivo;
    public $scadenza;
    public $modalitaAssegnazione;
    public $cig;
    /* public $homepage; */
    /* public $dataUltimoAggiornamento; */
    public $utenteId;
    public $settoreId;
    public $sceltaContraenteId;
    public $respProcId;
    public $dataInserimento;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                       = (isset($data['id'])) ? $data['id']        : null;
        $this->titolo                   = (isset($data['titolo']))                  ? $data['titolo']   : null;
        $this->numeroDetermina          = (isset($data['numeroDetermina']))         ? $data['numeroDetermina']   : null;
        $this->dataDetermina            = (isset($data['dataDetermina']))           ? $data['dataDetermina']   : null;
        $this->importoAggiudicazione    = (isset($data['importoAggiudicazione']))   ? $data['importoAggiudicazione'] : null;
        $this->importoLiquidato         = (isset($data['importoLiquidato']))        ? $data['importoLiquidato'] : null;
        $this->numeroOfferte            = (isset($data['numeroOfferte']))           ? $data['numeroOfferte']   : null;
        $this->dataInizioLavori         = (isset($data['dataInizioLavori']))        ? $data['dataInizioLavori']   : null;
        $this->dataFineLavori           = (isset($data['dataFineLavori']))          ? $data['dataFineLavori']   : null;
        $this->anno                     = (isset($data['anno']))                    ? $data['anno']   : null;
        $this->data                     = (isset($data['data']))                    ? $data['data']   : null;
        $this->ora                      = (isset($data['ora']))                     ? $data['ora']   : null;
        $this->attivo                   = (isset($data['attivo']))                  ? $data['attivo']   : null;
        $this->scadenza                 = (isset($data['scadenza']))                ? $data['scadenza']   : null;
        $this->modalitaAssegnazione     = (isset($data['modalitaAssegnazione']))    ? $data['modalitaAssegnazione']   : null;
        $this->cig                      = (isset($data['cig']))                     ? $data['cig']   : null;
        $this->utenteId                 = (isset($data['utenteId']))               ? $data['utenteId']            : null;
        $this->settoreId                = (isset($data['settoreId']))              ? $data['settoreId']           : null;
        $this->sceltaContraenteId       = (isset($data['sceltaContraenteId']))      ? $data['sceltaContraenteId']   : null;
        $this->respProcId               = (isset($data['respProcId']))              ? $data['respProcId']           : null;
        $this->dataInserimento          = (isset($data['dataInserimento']))         ? $data['dataInserimento']      : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("This method is unused");
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
                    array('name' => 'HtmlEntities'),
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
                'name'     => 'beneficiario',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(

                ),
            ));

            $inputFilter->add(array(
                'name'     => 'titolo',
                'required' => true,
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
                'name'     => 'numeroDetermina',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataDetermina',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
                'validators' => array(

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
                'name'     => 'sceltaContraenteId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'respProcId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataInserimento',
                'required' => true,
                'filters'  => array(

                ),
            ));

            $inputFilter->add(array(
                'name'     => 'numeroOfferte',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'modalitaAssegnazione',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'settoreId',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataInizioLavori',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataFineLavori',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}