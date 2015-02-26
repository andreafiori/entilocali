<?php

namespace Admin\Model\Sezioni;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 February 2015
 */
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
            'name' => 'idSottosezione',
            'attributes' => array(
                "class" => 'hiddenField'
            )
        ));
    }

    public function addFormOptions()
    {
        /*
        $this->add(array(
            'name' => 'immagine',
            'type' => 'File',
            'options' => array( 'label' => 'Immagine' ),
            'attributes' => array(
                'placeholder'   => 'Immagine...',
                'title'         => 'Inserisci immagine',
                'id'            => 'immagine',
            )
        ));
        */
        $this->add(array(
            'name' => 'nomeSottosezione',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sotto sezione',
                'id'            => 'nomeSottosezione',
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
                'required'      => 'required',
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