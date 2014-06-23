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
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'sezioneId',
                        'options' => array(
                               'label' => 'Sezione',
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
                        'type' => 'Date',
                        'name' => 'insertDate',
                        'options' => array(
                                'label' => 'Data di pubblicazione',
                                'format' => 'Y-m-d',
                        ),
                        'attributes' => array(
                                'class' => 'form-control DatePicker',
                                'style' => 'width: 22%',
                                'id' => 'insertDate'
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
    }
}