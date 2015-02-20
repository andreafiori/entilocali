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
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

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

        $this->add(array(
            'name' => 'nomeSezione',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'placeholder'   => 'Nome...',
                'title'         => 'Inserisci nome sotto sezione',
                'id'            => 'nomeSezione',
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
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                "class" => 'hiddenField'
            )
        ));
    }
}