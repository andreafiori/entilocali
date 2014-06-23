<?php

namespace Application\Model\Users;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  19 June 2014
 */
class RegistrationForm extends Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Email', 
            'attributes' => array( 
                'placeholder'   => 'Inserisci email...',
                'title'         => 'Inserisci email',
                'required'      => 'required',
                'id'            => 'email'
            ), 
            'options' => array( 
                'label' => 'E-mail', 
            ), 
        ));
        
        $this->add(array( 
            'name' => 'password', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes' => array( 
                'placeholder' => 'Inserisci password...',
                'title' => 'Inserisci password',
                'required' => 'required',
                'id' => 'password'
            ), 
            'options' => array( 
                'label' => 'Password', 
            ),
        ));
        
        $this->add(array(
            'name' => 'password_confirm', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes'        => array(
                'placeholder'   => 'Conferma password...',
                'title'         => 'Conferma password',
                'required'      => 'required',
                'id'            => 'password_confirm'
            ),
            'options' => array(
                'label' => 'Conferma password', 
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes'    => array(
                'type'      => 'submit',
                'value'     => 'Procedi',
                'title'     => 'Procedi con la registrazione',
                'id'        => 'submitbutton',
            ),
        ));
    }
}
