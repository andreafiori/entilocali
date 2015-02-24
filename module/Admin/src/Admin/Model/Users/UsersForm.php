<?php

namespace Admin\Model\Users;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class UsersForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null)
    {
        parent::__construct('formData');
        
        $this->add(array(
                        'name' => 'name',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'title' => 'Inserisci il nome',
                                        'placeholder' => 'Inserisci il nome',
                                        'id' => 'name',
                        )
        ));
        
        $this->add(array(
                        'name' => 'surname',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Cognome' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'title'    => 'Inserisci il cognome',
                                        'placeholder' => 'Inserisci il cognome',
                                        'id'          => 'surname',
                        )
        ));
        
        $this->add(array(
                        'name' => 'email',
                        'type' => 'Email',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'title'     => 'Inserisci indirizzo email',
                                        'placeholder' => 'Inserisci indirizzo email',
                                        'id'        => 'email',
                        )
        ));
        
        $this->add(array(
                        'name' => 'username',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome utente' ),
                        'attributes' => array(
                                        'required'      => 'required',
                                        'title'         => 'Inserisci nome utente',
                                        'placeholder'   => 'Nome utente',
                                        'id'            => 'username',
                        )
        ));
        
        $this->add(array(
                        'name' => 'password',
                        'type' => 'Password',
                        'options' => array( 'label' => 'Password' ),
                        'attributes' => array(
                                        'title' => 'Inserisci password',
                                        'placeholder' => 'Inserisci una password',
                                        'id'    => 'password',
                        )
        ));
        
        $this->add(array(
                        'name' => 'password-confirm',
                        'type' => 'Password',
                        'options' => array( 'label' => 'Conferma password' ),
                        'attributes' => array(
                                        'title' => 'Conferma password',
                                        'placeholder' => 'Conferma password',
                                        'id'    => 'password-confirm',
                        )
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'old-password',
                        'attributes' => array("class" => 'hiddenField')
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id',
                        'attributes' => array("class" => 'hiddenField')
        ));
    }
    
    public function addLastUpdatePassword()
    {
        $this->add(array(
                        'type' => 'Application\Form\Element\PlainText',
                        'name' => 'lastUpdatePassword',
                        'attributes' => array(
                                        'id'    => 'lastUpdatePassword',
                                        'value' => 'Ultimo aggiornamento password: '.$this->getValue('lastUpdatePassword'),
                        ),
        ));
    }
}

