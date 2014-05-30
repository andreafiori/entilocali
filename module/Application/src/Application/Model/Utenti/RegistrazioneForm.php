<?php

namespace Application\Model\Utenti;

use Zend\Form\Form;


class RegistrazioneForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Inserisci email...',
                'title' => 'Inserisci email...',
                'required' => 'required',
                'id' => 'email'
            ), 
            'options' => array( 
                'label' => 'E-mail', 
            ), 
        ));
        
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes' => array( 
                'placeholder' => 'Inserisci password...',
                'title' => 'Inserisci password...',
                'required' => 'required',
                'id' => 'password'
            ), 
            'options' => array( 
                'label' => 'Password', 
            ),
        ));
        
        $this->add(array(
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes' => array(
                'placeholder' => 'Conferma password...',
                'title' => 'Conferma password...',
                'required' => 'required',
                'id' => 'password_confirm'
            ),
            'options' => array(
                'label' => 'Conferma password', 
            ),
        ));
    }
}
