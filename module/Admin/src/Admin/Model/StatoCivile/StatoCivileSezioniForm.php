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
                        'options' => array( 'label' => 'Nome' ),
                        'attributes' => array(
                                        'id'       => 'nome',
                                        'required' => 'required',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'stato',
                        'options' => array(
                               'label' => 'Sezione',
                               'value_options' => array(
                                       '' => 'Seleziona',
                                       'attivo'   => 'Attivo',
                                       'nascosto' => 'Nascosto',
                               ),
                        ),
                        'attributes' => array(
                                'id' => 'stato'
                        )
        ));
    }
}