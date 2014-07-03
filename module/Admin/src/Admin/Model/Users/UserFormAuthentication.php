<?php

namespace Admin\Model\Users;

/**
 * @author Andrea Fiori
 * @since  25 June 2014
 */
class UserFormAuthentication extends \Zend\Form\Form
{
    /**
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                    'name' => 'username',
                    'type' => 'Text',
                    'attributes' => array(
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'placeholder' => 'Email o nome utente...',
                                    'title' => 'Inserisci email o nome utente',
                                    'id' => 'username',
                    )
        ));
        
        $this->add(array(
                    'name' => 'password',
                    'type' => 'Password',
                    'attributes' => array(
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'placeholder' => 'Password...',
                                    'title' => 'Inserisci la password',
                                    'id' => 'password',
                    )
        ));
    }
    
}