<?php

namespace Application\Form;

use Zend\Form\Form;

/**
 * Contact Form
 * 
 * @author Andrea Fiori
 * @since  20 April 2014
 */
class ContattiForm extends Form 
{
    public function __construct($name = null) 
    {
        parent::__construct($name);
                
        $this->add(array( 
            'name' => 'nome', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Inserisci nome...',
                'title' => 'Inserisci nome...',
                'required' => 'required',
            ), 
            'options' => array( 
                'label' => 'Nome', 
            ), 
        ));
 
        $this->add(array( 
            'name' => 'cognome', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Inserisci cognome...', 
                'title' => 'Inserisci cognome...', 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Cognome', 
            ), 
        )); 
        
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Email', 
            'attributes' => array( 
                'placeholder' => 'Inserisci indirizzo Email...', 
                'title' => 'Inserisci indirizzo Email...', 
                'required' => 'required', 
            ), 
            'options' => array(
                'label' => 'Email', 
            ),
        ));
 
        $this->add(array( 
            'name' => 'messaggio', 
            'type' => 'Zend\Form\Element\Textarea', 
            'attributes' => array( 
                'placeholder' => 'Inserisci il messagio...',
                'title' => 'Inserisci il messagio...', 
                'required' => 'required',
                'rows' => 8,
                'cols' => 35
            ), 
            'options' => array( 
                'label' => 'Messaggio', 
            ), 
        ));
        
        /*
        $this->add(array(  
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));
        
        // CAPTCHA
        $this->add( array( 'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'CAPTCHA',
                'captcha' => array(
                    'class' => 'Dumb',
                ),
            ),
            'attributes' => array(
                'type' => 'captcha',
                'required' => 'required',
            ),
         ) );
        // END CAPTHCHA
        */
        
        $this->add(array(
            'name' => 'send',
            'type'  => 'submit',
            'attributes' => array(
                'label' => '&nbsp;',
                'value' => 'Invia',
            ))
        );
    }
}