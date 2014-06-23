<?php

namespace Admin\Model\Users;

use Zend\Form\Form;

/**
 * TODO: 
 *      insert password strength
 *      insert checkboxes to set permissions
 * 
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class UsersForm extends Form
{
    /**
     * @param type $name
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
                                        'class' => 'form-control',
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
                                        'class'    => 'form-control',
                                        'title'    => 'Inserisci il cognome',
                                        'placeholder' => 'Inserisci il cognome',
                                        'id'       => 'surname',
                        )
        ));
        
        $this->add(array(
                        'name' => 'email',
                        'type' => 'Email',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                        'required'  => 'required',
                                        'class'     => 'form-control',
                                        'title'     => 'Inserisci indirizzo email',
                                        'placeholder' => 'Inserisci indirizzo email',
                                        'id'        => 'email',
                        )
        ));
        
        /* BEGIN GEO */
        /*
        $this->add(array(
                        'name' => 'address',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Indirizzo' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci indirizzo email',
                                        'id' => 'address',
                        )
        ));
        
        $this->add(array(
                        'name' => 'city',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Citt&agrave;' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => "Inserisci Città",
                                        'id' => 'city',
                        )
        ));
        
        $this->add(array(
                        'name' => 'zip',
                        'type' => 'Text',
                        'options' => array( 'label' => 'CAP' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci CAP \ ZIP code',
                                        'id'    => 'zip',
                        )
        ));
        
        $this->add(array(
                        'name' => 'nation',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Nazione' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci Nazione',
                                        'id'    => 'city',
                        )
        ));
        */
        /* END GEO */
        
        $this->add(array(
                        'name' => 'username',
                        'type' => 'Text',
                        'options' => array( 'label' => 'Nome utente' ),
                        'attributes' => array(
                                        'class' => 'form-control',
                                        'title' => 'Inserisci nome utente',
                                        'placeholder' => 'Inserisci nome utente',
                                        'id'    => 'username',
                        )
        ));
        
        $this->add(array(
                        'name' => 'password',
                        'type' => 'Password',
                        'options' => array( 'label' => 'Password' ),
                        'attributes' => array(
                                        'class' => 'form-control',
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
                                        'class' => 'form-control',
                                        'title' => 'Conferma password',
                                        'placeholder' => 'Conferma password',
                                        'id'    => 'password-confirm',
                        )
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

