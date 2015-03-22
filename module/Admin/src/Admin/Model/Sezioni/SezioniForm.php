<?php

namespace Admin\Model\Sezioni;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 February 2015
 */
class SezioniForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sezione',
                'id'            => 'nome',
            )
        ));
    }

    /**
     * @param array $languages
     */
    public function addLingue(array $languages)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'lingua',
            'options' => array(
                'label' => '* Lingua',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'it'   => 'Italiano',
                    'en'   => 'English',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'title' => 'Seleziona lingua',
                'id'    => 'lingua'
            )
        ));
    }

    public function addOptions()
    {
        $this->add(array(
            'name' => 'url',
            'type' => 'Text',
            'options' => array(
                'label' => 'Link (se esterno indicare anche http://):'
            ),
            'attributes' => array(
                'placeholder'   => 'Link...',
                'title'         => 'Inserisci nome sezione',
                'id'            => 'url',
            )
        ));

        $this->add(array(
            'name' => 'image',
            'type' => 'File',
            'options' => array( 'label' => 'Immagine' ),
            'attributes' => array(
                'placeholder'   => 'Immagine...',
                'title'         => 'Inserisci immagine',
                'id'            => 'image',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'colonna',
            'options' => array(
                'label' => '* Colonna',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    'sx'   => 'Sinistra',
                    'dx'   => 'Destra',
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'title' => 'Seleziona colonna',
                'id'    => 'colonna'
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
                'required' => 'required',
                'title'    => 'Seleziona stato',
                'id'       => 'attivo'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'blocco',
            'options' => array(
                'label' => 'Crea un blocco per questa sezione',
                'checked_value'     => 1,
                'unchecked_value'   => 0
            ),
            'attributes' => array(
                'id'    => 'blocco',
                'title' => 'Spunta la casella per creare un blocco sulla sezione'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'posizione',
            'attributes' => array(
                "class" => 'hiddenField',
                'id' => 'posizione'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField',
                'id' => 'id'
            )
        ));
    }
}
