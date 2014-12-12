<?php

namespace Admin\Model\StatoCivile;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  17 June 2014
 */
class StatoCivileSezioniForm extends Form
{
    public function __construct($name = 'formData', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                        'name' => 'nome',
                        'type' => 'Textarea',
                        'options' => array('label' => '* Nome'),
                        'attributes' => array(
                                    'required' => 'required',
                                    'id'       => 'nome',
                                    'required' => 'required',
                                    'title'    => 'Inserisci nome sezione'
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'attivo',
                        'options' => array(
                                'label' => '* Stato',
                                'empty_option' => 'Seleziona',
                                'value_options' => array(
                                       '1'   => 'Attivo',
                                       '0' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'required' => 'required',
                                'id' => 'attivo',
                                'title' => 'Seleziona stato',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
}