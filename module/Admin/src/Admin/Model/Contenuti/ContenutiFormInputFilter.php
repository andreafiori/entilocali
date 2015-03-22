<?php

namespace Admin\Model\Contenuti;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @author Andrea Fiori
 * @since  20 March 2015
 */
class ContenutiFormInputFilter implements InputFilterAwareInterface
{
    public $id;
    public $sottosezione;
    public $titolo;
    public $sommario;
    public $testo;
    public $dataInserimento;
    public $dataScadenza;
    public $attivo;
    public $homepage;
    public $rss;
    public $facebook;

    private $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id               = (isset($data['id']))              ? $data['id']               : null;
        $this->sottosezione     = (isset($data['sottosezione']))    ? $data['sottosezione']     : null;
        $this->titolo           = (isset($data['titolo']))          ? $data['titolo']           : null;
        $this->sommario         = (isset($data['sommario']))        ? $data['sommario']         : null;
        $this->testo            = (isset($data['testo']))           ? $data['testo']            : null;
        $this->dataInserimento  = (isset($data['dataInserimento'])) ? $data['dataInserimento']  : null;
        $this->dataScadenza     = (isset($data['dataScadenza']))    ? $data['dataScadenza']     : null;
        $this->attivo           = (isset($data['attivo']))          ? $data['attivo']           : null;
        $this->homepage         = (isset($data['homepage']))        ? $data['homepage']         : null;
        $this->rss              = (isset($data['rss']))             ? $data['rss']              : null;
        $this->facebook         = (isset($data['facebook']))        ? $data['facebook']         : null;
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("This method is unused");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'sottosezione',
                'required' => true,
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
                'name'     => 'sommario',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'testo',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataInserimento',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'dataScadenza',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'attivo',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'homepage',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'rss',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'facebook',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'utente',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}