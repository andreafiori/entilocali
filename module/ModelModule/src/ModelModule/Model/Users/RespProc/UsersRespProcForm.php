<?php

namespace ModelModule\Model\Users\RespProc;

use Zend\Form\Form;

class UsersRespProcForm extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
    }

    /**
     * @param array $records
     */
    public function addUsers($records)
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'user',
            'options' => array(
                'label'          => '* Utente',
                'empty_option'   => 'Seleziona',
                'value_options'  => $records,
            ),
            'attributes' => array(
                'id'        => 'ufficioResponsabile',
                'title'     => 'Seleziona utente',
                'required'  => 'required',
            )
        ));
    }
}