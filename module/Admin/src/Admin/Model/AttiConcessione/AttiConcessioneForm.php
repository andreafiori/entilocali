<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AttiConcessioneForm extends Form
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
                        'name' => 'beneficiario',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Beneficiario CF / P.IVA' ),
                        'attributes' => array(
                                        'title'     => 'Beneficiario CF / P.IVA',
                                        'id'        => 'beneficiario',
                                        'required'  => 'required',
                                        'rows'      => '8',
                        )
        ));

        $this->add(array(
                        'name' => 'importo',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Importo (Euro)' ),
                        'attributes' => array(
                                        'title'         => 'Inserisci importo (Euro)',
                                        'id'            => 'importo',
                                        'placeholder'   => 'Importo...',
                                        'required'      => 'required',
                        )
        ));
    }

    /**
     * @param $records
     */
    public function addUfficioResponsabile($records)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'ufficioResponsabile',
                        'options' => array(
                               'label'          => '* Ufficio Responsabile',
                               'empty_option'   => 'Seleziona',
                               'value_options'  => $records,
                        ),
                        'attributes' => array(
                                'id'        => 'ufficioResponsabile',
                                'title'     => 'Seleziona Ufficio Responsabile',
                                'required'  => 'required',
                        )
        ));
    }

    public function addResponsabileProcedimento()
    {
        /* TODO: respProc
        $this->add(array(
            'name' => 'respProc',
            'type' => 'Text',
            'options' => array( 'label' => 'Responsabile del procedimento' ),
            'attributes' => array(
                'title' => 'Responsabile del procedimento',
                'id'    => 'respProc',
            )
        ));
        */
    }

    public function addModalitaAssegnazione()
    {
        $this->add(array(
                        'name' => 'modassegn',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Modalit&agrave; assegnazione' ),
                        'attributes' => array(
                                        'title'         => 'Modalit&agrave; assegnazione',
                                        'placeholder'   => 'Modalit&agrave; assegnazione...',
                                        'id'            => 'modassegn',
                                        'required'      => 'required',
                        )
        ));

        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Text',
                        'options' => array( 'label' => "Norma o Titolo a base dell'attribuzione" ),
                        'attributes' => array(
                            'title'         => "* Norma o Titolo a base dell'attribuzione",
                            'id'            => 'titolo',
                            'placeholder'   => 'Norma o titolo...',
                        )
        ));

        $this->add(array(
            'type' => 'Date',
            'name' => 'dataInserimento',
            'options' => array(
                'label' => "Data inserimento:",
                'format' => 'Y-m-d',
            ),
            'attributes' => array(
                'id'            => 'data',
                'required'      => 'required',
                'type'          => 'date',
                'placeholder'   => 'Data inserimento...',
            )
        ));

        $this->add(array(
            'name' => 'anno',
            'type' => 'Text',
            'options' => array( 'label' => "Anno del Bando" ),
            'attributes' => array(
                'title' => "Anno del Bando",
                'id'    => 'anno',
                'type' => 'number',
                'min' => '1954',
                'max' => '2054',
                'placeholder' => 'Anno...',
            )
        ));

        // Data scadenza: 5 Anni a partire dall'anno successivo a quello di inserimento

        // Associa articolo a utente: se utente non admin visualizza id campo nascosto, altrimenti select area

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class"=>'hiddenField')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'userId',
            'attributes' => array("class"=>'hiddenField')
        ));
    }

    /**
     * Set a single option for an element
     *
     * @param  string $key
     * @param  mixed $value
     * @return self
     */
    public function setOption($key, $value)
    {
        // TODO: Implement setOption() method.
    }
}
