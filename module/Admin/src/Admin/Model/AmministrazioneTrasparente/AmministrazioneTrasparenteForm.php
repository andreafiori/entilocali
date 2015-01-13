<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Zend\Form\Form;

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
                               'label' => 'Sezione',
                               'empty_option' => 'Seleziona',
                               'value_options' => $sezioni,
                        ),
                        'attributes' => array(
                               'id' => 'sezione'
                        )
        ));
    }
    
    public function addEndForm()
    {
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Titolo' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'title' => 'Inserisci il titolo',
                                        'id'    => 'titolo',
                        )
        ));
        
        $this->add(array(
                        'name' => 'sommario',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Sotto titolo' ),
                        'attributes' => array(
                                        'title' => 'Inserisci il sottotitolo',
                                        'class' => 'wysiwyg',
                                        'id' => 'sommario',
                        )
        ));
        
        $this->add(array(
                        'name' => 'testo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => '* Testo' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'wysiwyg',
                                        'title' => 'Inserisci il testo',
                                        'id'    => 'testo',
                        )
        ));
        
        $this->add(array(
                        'name' => 'anno',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Anno' ),
                        'attributes' => array(
                                        'required' => 'required',                                        
                                        'title' => 'Anno di riferimento',
                                        'id'    => 'anno',
                        )
        ));
        
        $this->add(array(
                        'name' => 'numero',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Numero' ),
                        'attributes' => array(
                                        'title' => 'Numero',
                                        'id'    => 'numero',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'dataInserimento',
                        'options' => array(
                                'label' => 'Data pubblicazione',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'    => 'numero'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'dataScadenza',
                        'options' => array(
                                'label' => 'Data scadenza',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'    => 'numero'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'status',
                        'options' => array(
                               'label' => 'Stato',
                                'empty_option' => 'Seleziona',
                               'value_options' => array(
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'id' => 'status'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Radio',
                        'name' => 'home',
                        'options' => array(
                               'label' => 'Inserisci in Home Page',
                               'value_options' => array(
                                       '1' => 'Si',
                                       '0' => 'No',
                               ),
                        ),
                        'attributes' => array(
                                'id' => 'home'
                        )
        ));
                
        $this->add(array(
                        'type' => 'Zend\Form\Element\Radio',
                        'name' => 'home',
                        'options' => array(
                               'label' => 'Inserisci nel box "Notizie"',
                               'value_options' => array(
                                       '1' => 'Si',
                                       '0' => 'No',
                               ),
                        ),
                        'attributes' => array(
                                'id' => 'home'
                        )
        ));
    }
}