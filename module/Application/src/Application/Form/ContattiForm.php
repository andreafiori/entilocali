<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Element;

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
        parent::__construct('contactForm');
                
        $this->add(array( 
            'name' => 'nome', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'placeholder' => 'Inserisci nome...',
                'title' => 'Inserisci nome...',
                'required' => 'required',
                'id' => 'nome'
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
                 'id' => 'cognome'
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
                'id' => 'email'
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
                'cols' => 35,
                'id' => 'messaggio'
            ), 
            'options' => array( 
                'label' => 'Messaggio', 
            ), 
        ));
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        
        // CAPTCHA
        $dumb = new Captcha\Dumb();
        $dumb->setLabel('Copia e incolla la seguente stringa:');
        
        $captcha = new Element\Captcha('captcha');
        $captcha->setCaptcha($dumb)->setLabel('Captcha');

        $this->add($captcha);
        // END CAPTHCHA
        
        $this->add(array(
            'name' => 'send',
            'type'  => 'submit',
            'attributes' => array(
                'label' => '&nbsp;',
                'value' => 'Invia',
                'id' => 'send'
            ))
        );
    }
}