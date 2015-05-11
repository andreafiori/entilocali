<?php

namespace Application\Model\AttiConcessione;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AttiConcessioneFormSearchInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $beneficiario;
    public $importo;
    public $ufficioResponsabile;
    public $modassegn;
    public $titolo;
    public $dataInserimento;
    public $anno;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                       = (isset($data['id']))                  ? $data['id']   : null;
        $this->beneficiario             = (isset($data['beneficiario']))        ? $data['beneficiario']   : null;
        $this->importo                  = (isset($data['importo']))             ? $data['importo']   : null;
        $this->ufficioResponsabile      = (isset($data['ufficioResponsabile'])) ? $data['ufficioResponsabile']   : null;
        $this->respProc                 = (isset($data['respProc']))            ? $data['respProc']   : null;
        $this->modAssegnazione          = (isset($data['modAssegnazione']))     ? $data['modAssegnazione']   : null;
        $this->titolo                   = (isset($data['titolo']))              ? $data['titolo']   : null;
        $this->dataInserimento          = (isset($data['dataInserimento']))     ? $data['dataInserimento']   : null;
        $this->anno                     = (isset($data['anno']))                ? $data['anno']   : null;
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
     * @return mixed
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'beneficiario',
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

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}