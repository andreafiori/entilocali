<?php

namespace ModelModule\Model\Users\Roles;

use Zend\Form\Form;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesForm extends Form
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

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
            'name' => 'description',
            'type' => 'Textarea',
            'options' => array('label' => 'Descrizione'),
            'attributes' => array(
                'title'         => 'Inserisci la descrizione',
                'placeholder'   => 'Descrizione...',
                'id'            => 'description',
                'rows'          => 8,
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'adminAccess',
            'options' => array(
                'label' => '* Tipo ruolo',
                'empty_option' => 'Seleziona',
                'value_options' => array(
                    1 => 'Utente area risevata',
                    0 => 'Community'
                ),
            ),
            'attributes' => array(
                'id'        => 'adminAccess',
                'title'     => 'Seleziona tipo di ruolo',
                'required'  => 'required',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array("class"=>'hiddenField')
        ));
    }
}
