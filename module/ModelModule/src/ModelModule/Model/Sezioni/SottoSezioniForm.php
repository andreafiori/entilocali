<?php

namespace ModelModule\Model\Sezioni;

use Zend\Form\Form;

class SottoSezioniForm extends Form
{
    /**
     * @param array $sezioni
     */
    public function addSezioni(array $sezioni)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sezione',
            'options' => array(
                'label' => '* Sezione',
                'disable_inarray_validator' => true,
                'empty_option' => 'Seleziona',
                'value_options' => $sezioni
            ),
            'attributes' => array(
                'required'  => 'required',
                'title'     => 'Seleziona sezione',
                'id'        => 'sezione'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'idSottoSezione',
            'attributes' => array(
                "class" => 'hiddenField'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));
    }

    public function addMainFormInputs()
    {
        $this->add(array(
            'name' => 'nomeSottoSezione',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sotto sezione',
                'id'            => 'nomeSottoSezione',
            )
        ));

        $this->add(array(
            'name' => 'url',
            'type' => 'Text',
            'options' => array( 'label' => 'URL' ),
            'attributes' => array(
                'placeholder'   => 'URL...',
                'title'         => 'Inserisci URL',
                'id'            => 'url',
            )
        ));

        $this->add(array(
            'name' => 'urlTitle',
            'type' => 'Text',
            'options' => array( 'label' => 'Descrizione URL' ),
            'attributes' => array(
                'placeholder'   => 'Descrizione URL...',
                'title'         => 'Inserisci descrizione URL',
                'id'            => 'urlTitle',
            )
        ));

        $this->add(array(
            'name' => 'posizione',
            'type' => 'Text',
            'options' => array( 'label' => '* Posizione' ),
            'attributes' => array(
                'type'          => 'number',
                'placeholder'   => 'Posizione...',
                'title'         => 'Inserisci numero posizione',
                'id'            => 'posizione',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'attivo',
            'options' => array(
                'label' => '* Stato',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1   => 'Attivo',
                    0   => 'Nascosto',
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona stato',
                'id'        => 'attivo',
                'required'  => 'required'
            )
        ));
    }
}