<?php

namespace ModelModule\Model\Users;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class CreateAccountForm extends Form
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
                'title'         => 'Inserisci email',
                'required'      => 'required',
                'id'            => 'email',
                'type'          => 'email'
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder'   => 'Password...',
                'title'         => 'Inserisci password',
                'required'      => 'required',
                'id'            => 'password',
                'maxlength'     => '50'
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));

        $this->add(array(
            'name' => 'password_verify',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder'   => 'Conferma password...',
                'title'         => 'Conferma password',
                'required'      => 'required',
                'id'            => 'password_confirm'
            ),
            'options' => array(
                'label' => 'Verifica password',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
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
