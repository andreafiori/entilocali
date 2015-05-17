<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Zend\Form\ElementInterface;
use Zend\Form\Form as Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AmministrazioneTrasparenteForm extends Form
{
    /**
     * @param array $sezioni
     */
    public function addSezione(array $sezioni)
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                               'label'          => '* Sezione',
                               'empty_option'   => 'Seleziona',
                               'value_options'  => $sezioni,
                        ),
                        'attributes' => array(
                                'id'        => 'sezione',
                                'title'     => 'Seleziona sezione',
                                'required'  => 'required',
                        ),
        ));
    }

    public function addEndForm()
    {
        $this->add(array(
                        'name'      => 'titolo',
                        'type'      => 'Text',
                        'options'   => array('label' => '* Titolo'),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'title'     => 'Inserisci il titolo',
                                        'id'        => 'titolo',
                                        'maxlength' => 255,
                        )
        ));
        
        $this->add(array(
                        'name' => 'sommario',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Sotto titolo' ),
                        'attributes' => array(
                                        'title' => 'Inserisci il sottotitolo',
                                        'id'    => 'sommario',
                        )
        ));
        
        $this->add(array(
                        'name' => 'testo',
                        'type' => 'Textarea',
                        'options' => array('label' => '* Testo'),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'class'     => 'wysiwyg',
                                        'title'     => 'Inserisci il testo',
                                        'id'        => 'testo',
                        ),
        ));

        $this->add(array(
                        'name' => 'anno',
                        'type' => 'Text',
                        'options' => array('label' => '* Anno'),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'title'     => 'Anno di riferimento',
                                        'id'        => 'anno',
                                        'type'      => 'number',
                        )
        ));

        $this->add(array(
                        'type' => 'Date',
                        'name' => 'dataScadenza',
                        'options' => array(
                                'label'     => '* Data scadenza',
                                'format'    => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'        => 'dataScadenza',
                                'required'  => 'required',
                        ),
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'attivo',
                        'options' => array(
                               'label' => 'Stato',
                               'empty_option' => 'Seleziona',
                               'value_options' => array(
                                       1 => 'Attivo',
                                       0 => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'id'        => 'attivo',
                                'required'  => 'required',
                                'title'     => 'Seleziona stato'
                        )
        ));

        $this->add(array(
                        'type' => 'Zend\Form\Element\Checkbox',
                        'name' => 'rss',
                        'options' => array(
                                'label'              => 'Sempre visibile sul sito pubblico',
                                'use_hidden_element' => true,
                                'checked_value'      => 1,
                                'unchecked_value'    => 0,
                        ),
                        'attributes' => array(
                                'id' => 'rss'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Checkbox',
                        'name' => 'home',
                        'options' => array(
                                'label' => 'Inserisci in Home Page',
                                'use_hidden_element' => true,
                                'checked_value'     => 1,
                                'unchecked_value'   => 0
                        ),
                        'attributes' => array(
                                'id' => 'home'
                        )
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'id',
                        'attributes'    => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'moduloId',
                        'attributes'    => array("class" => 'hiddenField')
        ));

        // Utente SELECT o HiddenField
        $this->add(array(
                        'type'          => 'Zend\Form\Element\Hidden',
                        'name'          => 'userId',
                        'attributes'    => array("class" => 'hiddenField')
        ));
        
        // Abilita la visibilità a un Gruppo di Atti Ufficiali:

        // Nessuno 2 - Delibere (in generale) 3 - Determine (in generale) 4 - Esiti (in generale)5 - Bandi (in generale)6 - Concorsi (in generale)
    }

    public function addSocial()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'facebook',
            'options' => array(
                'label'             => 'Inserisci su facebook',
                'checked_value'     => 1,
                'unchecked_value'   => 0,
            ),
            'attributes' => array(
                'id'    => 'facebook',
                'title' => "Spunta la casella per postare l'articolo su facebook"
            )
        ));
    }
}