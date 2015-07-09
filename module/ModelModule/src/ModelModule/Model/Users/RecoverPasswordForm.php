<?php

namespace ModelModule\Model\Users;

use Zend\Form\Form;

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
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'placeholder'   => 'Email...',
                'title'         => 'Inserisci email per richiedere il recupero password',
                'required'      => 'required',
                'id'            => 'email'
            ),
            'options' => array( 
                'label' => 'E-mail',
            ), 
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }

    public function addSubmitButton()
    {
        $this->add(array(
            'name' => 'submitbutton',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Procedi',
                'title' => 'Procedi con la richiesta di recupero password',
                'id'    => 'submitbutton',
            ),
        ));
    }
}
