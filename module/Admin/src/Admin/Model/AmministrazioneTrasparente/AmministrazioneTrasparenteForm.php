<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Zend\Form\Form;

/**
 * TODO: check category \ sezioni, add sezioni records
 * 
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AmministrazioneTrasparenteForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

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
                        'name' => 'sottotitolo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Sottotitolo' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci il titolo',
                                        'class' => 'wysiwyg',
                                        'id' => 'sottotitolo',
                        )
        ));
        
        $this->add(array(
                        'name' => 'testo',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Testo' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'class' => 'wysiwyg',
                                        'title' => 'Inserisci il testo',
                                        'id' => 'testo',
                        )
        ));
        
    }
    
    public function addSezione()
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezione',
                        'options' => array(
                               'label' => 'Sezione',
                               'value_options' => array(
                                       '' => 'Seleziona',
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'id' => 'sezione'
                        )
        ));
    }
    
    public function addEndForm()
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'status',
                        'options' => array(
                               'label' => 'Stato',
                               'value_options' => array(
                                       '' => 'Seleziona',
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
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'modulo',
                        'options' => array(
                               'label' => 'Modulo',
                               'value_options' => array(
                                       '' => 'Seleziona',
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