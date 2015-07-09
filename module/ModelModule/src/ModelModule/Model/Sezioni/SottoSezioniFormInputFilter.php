<?php

namespace ModelModule\Model\Sezioni;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\File\Size;

/**
 * SottoSezioni Admin Form Valildator
 */
class SottoSezioniFormInputFilter implements InputFilterAwareInterface
{
    public $idSottoSezione;
    public $sezione;
    public $nomeSottoSezione;
    public $url;
    public $urlTitle;
    public $posizione;
    public $attivo;

    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->idSottoSezione   = (isset($data['idSottoSezione']))    ? $data['idSottoSezione']   : null;
        $this->sezione          = (isset($data['sezione']))           ? $data['sezione']          : null;
        $this->nomeSottoSezione = (isset($data['nomeSottoSezione']))  ? $data['nomeSottoSezione'] : null;
        $this->url              = (isset($data['url']))               ? $data['url']              : null;
        $this->urlTitle         = (isset($data['urlTitle']))          ? $data['urlTitle']         : null;
        $this->attivo           = (isset($data['attivo']))            ? $data['attivo']           : null;
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add(array(
                'name'     => 'idSottoSezione',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
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
                'name'     => 'sezione',
                'required' => true,
                'options' => array(
                    'disable_inarray_validator' => false
                ),
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add($factory->createInput([
                'name' => 'nomeSottoSezione',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ]));

            $inputFilter->add(array(
                'name' => 'url',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'urlTitle',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'HtmlEntities'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'attivo',
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