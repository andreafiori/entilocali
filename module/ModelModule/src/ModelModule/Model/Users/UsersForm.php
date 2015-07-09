<?php

namespace ModelModule\Model\Users;

use Zend\Form\Form;

class UsersForm extends Form
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class" => 'hiddenField')
        ));

        $this->add(array(
                        'name' => 'name',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Nome' ),
                        'attributes' => array(
                                        'required'      => 'required',
                                        'title'         => 'Inserisci il nome',
                                        'placeholder'   => 'Nome...',
                                        'id'            => 'name',
                        )
        ));
        
        $this->add(array(
                        'name' => 'surname',
                        'type' => 'Text',
                        'options' => array( 'label' => '* Cognome' ),
                        'attributes' => array(
                                        'required' => 'required',
                                        'title'         => 'Inserisci il cognome',
                                        'placeholder'   => 'Cognome...',
                                        'id'            => 'surname',
                        )
        ));
        
        $this->add(array(
                        'name' => 'email',
                        'type' => 'Email',
                        'options' => array( 'label' => '* Email' ),
                        'attributes' => array(
                                        'required'      => 'required',
                                        'title'         => 'Inserisci indirizzo email',
                                        'placeholder'   => 'Inserisci indirizzo email',
                                        'id'            => 'email',
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
    }

    public function addPasswords()
    {
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array('label' => 'Password'),
            'attributes' => array(
                'title'         => 'Inserisci password',
                'placeholder'   => 'Inserisci una password',
                'id'            => 'password',
                'class'         => 'passwordStrength',
            )
        ));

        $this->add(array(
            'name' => 'password_verify',
            'type' => 'Password',
            'options' => array( 'label' => 'Conferma password' ),
            'attributes' => array(
                'title'         => 'Conferma password',
                'placeholder'   => 'Conferma password',
                'id'            => 'password_verify',
            )
        ));
    }

    public function addPasswordsMandatory()
    {
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array('label' => '* Password'),
            'attributes' => array(
                'title'         => 'Inserisci password',
                'placeholder'   => 'Inserisci una password',
                'required'      => 'required',
                'id'            => 'password',
                'class'         => 'passwordStrength',
            )
        ));

        $this->add(array(
            'name' => 'password_verify',
            'type' => 'Password',
            'options' => array( 'label' => '* Conferma password' ),
            'attributes' => array(
                'title'         => 'Conferma password',
                'placeholder'   => 'Conferma password',
                'required'      => 'required',
                'id'            => 'password_verify',
            )
        ));
    }

    public function addState()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label'         => '* Stato',
                'empty_option'  => 'Seleziona',
                'value_options' => array(
                    'active'        => 'Attivo',
                    'deleted'       => 'Eliminato',
                    'banned'        => 'Bannato',
                    'not_confirmed' => 'Non confermato',
                ),
            ),
            'attributes' => array(
                'title'     => 'Seleziona stato utente',
                'id'        => 'status',
                'required'  => 'required'
            )
        ));
    }

    /**
     * @param array $records
     */
    public function addRoles(array $records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'roleId',
            'options' => array(
                'label'         => '* Ruolo',
                'empty_option'  => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title'     => 'Seleziona ruolo utente',
                'id'        => 'roleId',
                'required'  => 'required'
            )
        ));
    }

    /**
     * @param array $records
     */
    public function addSettori(array $records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'settoreId',
            'options' => array(
                'label'         => 'Settore',
                'empty_option'  => 'Seleziona',
                'value_options' => $records,
            ),
            'attributes' => array(
                'title' => 'Seleziona settore',
                'id'    => 'settoreId',
            )
        ));
    }
}

