<?php

namespace Admin\Model\StatoCivile;

use Zend\Form\Form;

/**
 * Stato Civile atti Backend Form
 * 
 * @author Andrea Fiori
 * @since  17 June 2014
 */
class StatoCivileForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Titolo' ),
                        'attributes' => array(
                                        'id'       => 'titolo',
                                        'required' => 'required',
                                        'palceholder' => 'Inserisci il titolo',
                                        'title' => 'Inserisci il titolo',
                                        'rows' => '8',
                        )
        ));
    }
    
    public function addSezioni(array $sezioni)
    {
        $this->add(array(
                    'type' => 'Zend\Form\Element\Select',
                    'name' => 'sezioneId',
                    'options' => array(
                           'label' => 'Sezione',
                           'empty_option' => 'Seleziona',
                           'value_options' => $sezioni,
                    ),
                    'attributes' => array(
                            'id' => 'status',
                            'required' => 'required',
                            'title' => 'Seleziona la sezione',
                    )
        ));
    }
    
    public function addDates()
    {
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'data',
                        'options' => array(
                                'label' => 'Data di pubblicazione',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id' => 'data',
                                'title' => 'Inserisci la data di pubblicazione',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'scadenza',
                        'options' => array(
                                'label'  => 'Data di scadenza',
                                'format' => 'Y-m-d H:i:s',
                        ),
                        'attributes' => array(
                                'id'          => 'scadenza',
                                'title'       => 'Inserisci la data di scadenza',
                                'placeholder' => 'Data di scadenza',
                        )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
            'attributes' => array(
                'title'         => 'Inserisci in home page',
                'id'            => 'home'
            ),
            'options' => array(
                'label' => 'Inserisci in home page',
                'use_hidden_element' => true,
                'checked_value'      => '1',
                'unchecked_value'    => '0'
            )
        ));
    }
    
    public function addId()
    {
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}