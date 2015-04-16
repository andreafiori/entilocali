<?php

namespace Application\Model\Users;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  19 June 2014
 */
class RecoverPasswordForm extends Form
{
    /**
     * @inheritdoc
     */
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
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Procedi',
                'title' => 'Procedi con la registrazione',
                'id' => 'submitbutton',
            ),
        ));
    }
}