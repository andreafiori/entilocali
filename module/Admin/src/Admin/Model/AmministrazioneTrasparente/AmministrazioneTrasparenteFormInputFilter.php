<?php

namespace Admin\Model\AmministrazioneTrasparente;

class AmministrazioneTrasparenteFormInputFilter
{
    public $id;
    public $sezione;
    public $titolo;
    public $sommario;
    public $testo;
    public $anno;
    public $dataScadenza;
    public $attivo;
    public $rss;
    public $home;
    public $moduloId;
    public $userId;
    public $facebook;

    protected $inputFilter;

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
                'options' => array(
                    'disable_inarray_validator' => false
                ),
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