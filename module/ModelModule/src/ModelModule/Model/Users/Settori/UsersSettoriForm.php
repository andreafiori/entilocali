<?php

namespace ModelModule\Model\Users\Settori;

use Zend\Form\Form;

class UsersSettoriForm extends Form
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
            'name' => 'nome',
            'type' => 'Text',
            'options' => array( 'label' => '* Nome' ),
            'attributes' => array(
                'required'      => 'required',
                'title'         => 'Inserisci il nome',
                'placeholder'   => 'Nome...',
                'id'            => 'nome',
            )
        ));
    }

    /**
     * @param array $records
     */
    public function addResponsabile($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'responsabileUserId',
            'options' => array(
                'label'          => '* Responsabile',
                'empty_option'   => 'Seleziona',
                'value_options'  => $records,
            ),
            'attributes' => array(
                'id'        => 'responsabileUserId',
                'title'     => 'Seleziona utente responsabile settore',
                'required'  => 'required',
            )
        ));
    }
}