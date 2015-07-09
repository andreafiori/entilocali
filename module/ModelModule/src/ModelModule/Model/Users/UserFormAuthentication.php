<?php

namespace ModelModule\Model\Users;

use Zend\Form\Form;

class UserFormAuthentication extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->add(array(
                    'name' => 'username',
                    'type' => 'Text',
                    'attributes' => array(
                                    'required'      => 'required',
                                    'placeholder'   => 'Email o nome utente...',
                                    'title'         => 'Inserisci email o nome utente',
                                    'id'            => 'username',
                    )
        ));
        
        $this->add(array(
                    'name' => 'password',
                    'type' => 'Password',
                    'attributes' => array(
                                    'required'      => 'required',
                                    'placeholder'   => 'Password...',
                                    'title'         => 'Inserisci la password',
                                    'id'            => 'password',
                    )
        ));

        /*
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        */
    }
}