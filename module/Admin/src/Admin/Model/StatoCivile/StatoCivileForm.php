<?php

namespace Admin\Model\StatoCivile;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2014
 */
class StatoCivileForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('formData', $options);
        
        $this->add(array(
                        'name' => 'titolo',
                        'type' => 'Textarea',
                        'options' => array( 'label' => 'Titolo' ),
                        'attributes' => array(
                                        'id'       => 'titolo',
                                        'required' => 'required',
                                        'palceholder' => 'Inserisci il titolo',
                                        'title' => 'Inserisci il titolo',
                        )
        ));
    }
    
    public function addSezioni($sezioni)
    {
        if (is_array($sezioni)) {
            
            
            
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
        
    }
    
    public function addDates()
    {
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'insertDate',
                        'options' => array(
                                'label' => 'Data di pubblicazione',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'class' => 'form-control DatePicker',
                                'style' => 'width: 22%',
                                'id' => 'insertDate',
                                'title' => 'Inserisci la data di pubblicazione',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Date',
                        'name' => 'expireDate',
                        'options' => array(
                                'label' => 'Scadenza',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'class' => 'form-control DatePicker',
                                'style' => 'width: 22%',
                                'id' => 'expireDate'
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
}