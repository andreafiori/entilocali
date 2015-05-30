<?php

namespace ModelModule\Model\AlboPretorio;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioArticoliFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $titolo;
    public $sezione;
    public $numeroProgressivo;
    public $numeroAtto;
    public $anno;
    public $enteTerzo;
    public $fonteUrl;
    public $numeroGiorniScadenza;
    public $dataScadenza;
    public $homepage;
    public $note;
    public $userId;
    public $checkRettifica;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id                       = (isset($data['id']))                      ? $data['id']   : null;
        $this->titolo                   = (isset($data['titolo']))                  ? $data['titolo'] : null;
        $this->sezione                  = (isset($data['sezione']))                 ? $data['sezione'] : null;
        $this->numeroProgressivo        = (isset($data['numeroProgressivo']))       ? $data['numeroProgressivo'] : null;
        $this->numeroAtto               = (isset($data['numeroAtto']))              ? $data['numeroAtto'] : null;
        $this->anno                     = (isset($data['anno']))                    ? $data['anno'] : null;
        $this->enteTerzo                = (isset($data['enteTerzo']))               ? $data['enteTerzo'] : null;
        $this->fonteUrl                 = (isset($data['fonteUrl']))                ? $data['fonteUrl'] : null;
        $this->numeroGiorniScadenza     = (isset($data['numeroGiorniScadenza']))    ? $data['numeroGiorniScadenza'] : null;
        $this->dataScadenza             = (isset($data['dataScadenza']))            ? $data['dataScadenza'] : null;
        $this->homepage                 = (isset($data['homepage']))                ? $data['homepage'] : null;
        $this->note                     = (isset($data['note']))                    ? $data['note'] : null;
        $this->userId                   = (isset($data['userId']))                  ? $data['userId'] : null;
        $this->checkRettifica           = (isset($data['checkRettifica']))          ? $data['checkRettifica'] : null;

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
                'name'     => 'numeroAtto',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'anno',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'enteTerzo',
                'required' => false,
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
                'name'     => 'fonteUrl',
                'required' => false,
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
                'name'     => 'numeroGiorniScadenza',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataScadenza',
                'required' => false,
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
                'name'     => 'note',
                'required' => false,
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
                'name'     => 'userId',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'checkRettifica',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'facebook',
                'required' => false,
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
